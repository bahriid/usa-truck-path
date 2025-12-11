<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Services\EnrollmentService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class EnrollmentController extends Controller
{
    protected EnrollmentService $enrollmentService;
    protected PaymentService $paymentService;

    public function __construct(EnrollmentService $enrollmentService, PaymentService $paymentService)
    {
        $this->enrollmentService = $enrollmentService;
        $this->paymentService = $paymentService;
    }

    public function showCurriculam(Request $request)
    {
        $course = Course::find($request->course);

        // Generate Telegram invite link if user is enrolled and hasn't got one yet
        if (auth()->check()) {
            $user = auth()->user();
            $this->enrollmentService->generateTelegramInvite($user, $course);
        }

        return view('new-design.curriculam', compact('course'));
    }

    /**
     * Show enrollment form for a course
     */
    public function showEnrollForm(Course $course)
    {
        $user = auth()->user();

        // For language_selector courses (free), auto-enroll and redirect to curriculum
        if ($user && $course->isLanguageSelectorCourse()) {
            if (!$this->enrollmentService->isUserEnrolled($user, $course)) {
                // Auto-enroll the user
                $this->enrollmentService->autoEnrollInFreeTier($user, $course);
            }
            return redirect()->route('course.curriculam', $course->id)
                ->with('success', 'You are enrolled in this free course!');
        }

        if ($user && $this->enrollmentService->isUserEnrolled($user, $course)) {
            // Check enrollment status
            $enrollment = $user->courses()->where('course_id', $course->id)->first();

            if ($enrollment->pivot->status === 'pending') {
                // If pending, show payment page to complete enrollment
                return view('new-design.payment', compact('course'));
            } elseif ($enrollment->pivot->status === 'approved') {
                // If already approved, redirect to curriculum
                return redirect()->route('course.curriculam', $course->id)
                    ->with('info', 'You are already enrolled in this course.');
            }
        }

        return view('new-design.enroll-form', compact('course'));
    }

    /**
     * Process enrollment form submission
     */
    public function processEnrollForm(Request $request, Course $course)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Please log in to enroll.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        // Check enrollment status
        $enrollment = $user->courses()->where('course_id', $course->id)->first();

        if ($enrollment) {
            if ($enrollment->pivot->status === 'approved') {
                // Already approved, redirect to curriculum
                return redirect()->route('course.curriculam', $course->id)
                    ->with('info', 'You are already enrolled in this course.');
            } elseif ($enrollment->pivot->status === 'pending') {
                // Pending payment, show payment page
                return view('new-design.payment', compact('course'));
            }
        }

        // For tier courses, auto-enroll in free tier
        if ($course->isTierCourse()) {
            $this->enrollmentService->autoEnrollInFreeTier($user, $course);

            return redirect()->route('dashboard')
                ->with('success', 'You have been enrolled in the free tier! You can upgrade anytime.');
        }

        // For paid courses, create enrollment and redirect to payment
        $transactionId = 'pending_' . time() . '_' . $user->id;

        $this->enrollmentService->enrollUser(
            $user,
            $course,
            $transactionId,
            'pending',
            'free'
        );

        // Redirect to payment page
        return view('new-design.payment', compact('course'));
    }

    public function createStripeCheckoutSession(Request $request)
    {
        // User must be logged in
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $request->validate([
            'course_id' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $course = Course::findOrFail($request->course_id);
        $price = $request->price;

        try {
            // Check if user already enrolled with approved status
            $enrollment = $user->courses()->where('course_id', $course->id)->first();

            if ($enrollment && $enrollment->pivot->status === 'approved') {
                return redirect()->route('course.curriculam', $course->id)
                    ->with('info', 'You are already enrolled in this course.');
            }

            // Allow payment for pending or new enrollments

            // PAYMENT DEBUG MODE: Bypass payment if enabled
            if (config('app.payment_debug', false)) {
                Log::info('Payment Debug Mode: Bypassing payment for user '.$user->id.' and course '.$course->id);

                // Generate a fake transaction ID for testing
                $fakeTransactionId = 'debug_'.uniqid();

                // Enroll user directly with approved status (if not already enrolled)
                if (!$enrollment) {
                    $this->enrollmentService->enrollUser($user, $course, $fakeTransactionId, 'pending');
                }

                // Get the enrollment
                $enrollment = $user->purchasedCourses()
                    ->where('course_id', $course->id)
                    ->first();

                // Complete enrollment (approve, notify, generate Telegram invite)
                $this->enrollmentService->completeEnrollment($user, $enrollment, $fakeTransactionId, $price);

                // Redirect to success
                return redirect()->route('front.course.details', $course->slug)
                    ->with('success', 'DEBUG MODE: Enrollment successful! Payment bypassed for testing.');
            }

            // Create Stripe checkout session
            $session = $this->paymentService->createCheckoutSession(
                $course,
                $price,
                url('/enrollment/success').'?session_id={CHECKOUT_SESSION_ID}',
                url('/enrollment/failure')
            );

            // Only create enrollment if it doesn't exist
            if (!$enrollment) {
                $this->enrollmentService->enrollUser($user, $course, $session->id, 'pending');
            } else {
                // Update transaction_id for existing pending enrollment
                $user->courses()->updateExistingPivot($course->id, [
                    'transaction_id' => $session->id
                ]);
            }

            // Redirect to Stripe Checkout
            return Redirect::to($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe Checkout error: '.$e->getMessage());

            return redirect()->route('enrollment.failure')->with('error', 'Failed to initiate checkout: '.$e->getMessage());
        }
    }

    public function handleSuccessfulPayment(Request $request)
    {
        // User must be logged in
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Get the Session ID
        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            Log::error('Success handler: Session ID is missing.');

            return redirect()->route('enrollment.failure')->with('error', 'Invalid payment session.');
        }

        try {
            // Verify Payment Status
            if (!$this->paymentService->verifyPayment($sessionId)) {
                Log::warning('Success handler: Payment not paid. Session ID: '.$sessionId);

                return redirect()->route('enrollment.failure')->with('error', 'Payment was not completed successfully.');
            }

            // Check if this is a tier upgrade (session data exists)
            $tierUpgradeSessionId = session('tier_upgrade_session_id');
            if ($tierUpgradeSessionId && $tierUpgradeSessionId === $sessionId) {
                return $this->processTierUpgrade($user, $sessionId);
            }

            // Get the enrollment from database using transaction_id
            $enrollment = $user->purchasedCourses()
                ->wherePivot('transaction_id', $sessionId)
                ->first();

            if (!$enrollment) {
                Log::error('Success handler: Course enrollment not found. Session ID: '.$sessionId);

                return redirect()->route('enrollment.failure')->with('error', 'Course enrollment not found.');
            }

            // Complete enrollment: approve, notify admin, generate Telegram invite
            $this->enrollmentService->completeEnrollment($user, $enrollment, $sessionId, $enrollment->price);

            // Redirect to Success Page
            return redirect()->route('front.course.details', $enrollment->slug)
                ->with('success', 'Enrollment successful! You are now enrolled in the course.');
        } catch (\Exception $e) {
            Log::error('Error in handleSuccessfulPayment: '.$e->getMessage().' Session ID: '.$sessionId);

            return redirect()->route('enrollment.failure')->with('error', 'Failed to process payment. Please contact support.');
        }
    }

    /**
     * Process tier upgrade after successful payment
     */
    protected function processTierUpgrade($user, string $sessionId)
    {
        $tier = session('tier_upgrade_tier');
        $courseId = session('tier_upgrade_course_id');
        $price = session('tier_upgrade_price', 0);

        if (!$tier || !$courseId) {
            Log::error('Tier upgrade: Missing session data');
            return redirect()->route('enrollment.failure')->with('error', 'Invalid upgrade session.');
        }

        $course = Course::findOrFail($courseId);

        // Upgrade tier
        $this->enrollmentService->upgradeTier($user, $course, $tier, $sessionId, $price);

        // Clear session data
        session()->forget(['tier_upgrade_session_id', 'tier_upgrade_tier', 'tier_upgrade_course_id', 'tier_upgrade_price']);

        // Redirect to dashboard
        return redirect()->route('dashboard')
            ->with('success', 'Congratulations! Your tier has been upgraded successfully.');
    }

    public function handleFailedPayment()
    {
        //  1. Log the error
        Log::warning('Payment failed or was canceled by user.');

        // 2.  Redirect to a failure page
        return redirect()->route('enrollment.failure.view')->with('error', 'Payment failed or was canceled. Please try again.');
    }



    public function showFailurePage()
    {
        return view('new-design.failure_page');
    }

    /**
     * Redirect to Telegram group invite link (Telegram handles one-time usage)
     */
    public function redeemTelegramInvite($courseId)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access the Telegram group.');
        }

        $course = Course::findOrFail($courseId);

        // Find the enrollment
        $enrollment = $this->enrollmentService->getUserEnrollment($user, $course);

        if (!$enrollment) {
            return redirect()->back()->with('error', 'You are not enrolled in this course.');
        }

        if ($enrollment->pivot->status !== 'approved') {
            return redirect()->back()->with('error', 'Your enrollment is not approved yet.');
        }

        // Check if invite link exists
        if (!$enrollment->pivot->telegram_invite_link) {
            return redirect()->back()->with('error', 'Telegram invite link is not available. Please refresh the page.');
        }

        // Redirect to the Telegram invite link
        // Telegram will enforce the one-time usage limit (member_limit=1)
        return redirect()->away($enrollment->pivot->telegram_invite_link);
    }

    /**
     * Show tier upgrade page
     */
    public function showTierUpgradePage(Course $course, string $tier)
    {
        $user = auth()->user();

        // Validate tier (only premium allowed)
        if ($tier !== 'premium') {
            return redirect()->back()->with('error', 'Invalid tier selected.');
        }

        // Check if user is enrolled
        if (!$this->enrollmentService->isUserEnrolled($user, $course)) {
            return redirect()->route('register')
                ->with('error', 'Please sign up for free access first.')
                ->with('course_id', $course->id);
        }

        // Get current tier
        $currentTier = $user->getSubscriptionTier($course->id);

        // Validate upgrade path (can only upgrade from free to premium once)
        if ($currentTier !== 'free') {
            return redirect()->route('dashboard')
                ->with('error', 'You already have Premium access or have already upgraded.');
        }

        // Get price for premium tier
        $price = $course->getPremiumPrice();

        return view('new-design.tier-upgrade', compact('course', 'tier', 'price', 'currentTier'));
    }

    /**
     * Create Stripe checkout session for tier upgrade
     */
    public function createTierUpgradeCheckout(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'tier' => 'required|in:premium',
            'price' => 'required|numeric',
        ]);

        $course = Course::findOrFail($request->course_id);
        $tier = $request->tier;
        $price = $request->price;

        try {
            // Check if user is enrolled
            if (!$this->enrollmentService->isUserEnrolled($user, $course)) {
                return redirect()->back()->with('error', 'Please sign up for free access first.');
            }

            // Get current tier
            $currentTier = $user->getSubscriptionTier($course->id);

            // Validate upgrade (can only upgrade from free to premium once)
            if ($currentTier !== 'free') {
                return redirect()->back()->with('error', 'You already have Premium access or have already upgraded.');
            }

            // PAYMENT DEBUG MODE: Bypass payment if enabled
            if (config('app.payment_debug', false)) {
                Log::info('Payment Debug Mode: Bypassing tier upgrade payment for user '.$user->id.' and course '.$course->id);

                $fakeTransactionId = 'debug_tier_upgrade_'.uniqid();

                // Upgrade tier directly
                $this->enrollmentService->upgradeTier($user, $course, $tier, $fakeTransactionId, $price);

                return redirect()->route('dashboard')
                    ->with('success', 'DEBUG MODE: Tier upgraded successfully!');
            }

            // Create Stripe checkout session (using /enrollment/success to avoid Mod_Security issues)
            $session = $this->paymentService->createCheckoutSession(
                $course,
                $price,
                url('/enrollment/success').'?session_id={CHECKOUT_SESSION_ID}',
                url('/enrollment/failure')
            );

            // Store tier upgrade info in session for success handler
            session([
                'tier_upgrade_session_id' => $session->id,
                'tier_upgrade_tier' => $tier,
                'tier_upgrade_course_id' => $course->id,
                'tier_upgrade_price' => $price,
            ]);

            // Redirect to Stripe Checkout
            return Redirect::to($session->url);
        } catch (\Exception $e) {
            Log::error('Tier upgrade checkout error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Failed to initiate checkout: '.$e->getMessage());
        }
    }

    /**
     * Handle successful tier upgrade payment
     */
    public function handleTierUpgradeSuccess(Request $request)
    {
        $user = auth()->user();

        $sessionId = $request->get('session_id');
        $tier = $request->get('tier');
        $courseId = $request->get('course_id');

        if (!$sessionId || !$tier || !$courseId) {
            Log::error('Tier upgrade success: Missing parameters');
            return redirect()->route('enrollment.failure')->with('error', 'Invalid upgrade session.');
        }

        try {
            // Verify payment
            if (!$this->paymentService->verifyPayment($sessionId)) {
                Log::warning('Tier upgrade: Payment not completed. Session: '.$sessionId);
                return redirect()->route('enrollment.failure')->with('error', 'Payment was not completed.');
            }

            $course = Course::findOrFail($courseId);

            // Get price from session
            $price = session('tier_upgrade_price', 0);

            // Upgrade tier
            $this->enrollmentService->upgradeTier($user, $course, $tier, $sessionId, $price);

            // Clear session data
            session()->forget(['tier_upgrade_session_id', 'tier_upgrade_tier', 'tier_upgrade_course_id', 'tier_upgrade_price']);

            // Redirect to dashboard
            return redirect()->route('dashboard')
                ->with('success', 'Congratulations! Your tier has been upgraded successfully.');
        } catch (\Exception $e) {
            Log::error('Error in handleTierUpgradeSuccess: '.$e->getMessage());
            return redirect()->route('enrollment.failure')->with('error', 'Failed to process upgrade. Please contact support.');
        }
    }
}
