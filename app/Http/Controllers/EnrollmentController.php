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

        return view('front.curriculam', compact('course'));
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
            // Check if user already enrolled
            if ($this->enrollmentService->isUserEnrolled($user, $course)) {
                return redirect()->back()->with('success', 'You already have an enrollment request or are already enrolled.');
            }

            // Create Stripe checkout session
            $session = $this->paymentService->createCheckoutSession(
                $course,
                $price,
                url('/enrollment/success').'?session_id={CHECKOUT_SESSION_ID}',
                url('/enrollment/failure')
            );

            // Enroll user with pending status
            $this->enrollmentService->enrollUser($user, $course, $session->id, 'pending');

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

    public function handleFailedPayment()
    {
        //  1. Log the error
        Log::warning('Payment failed or was canceled by user.');

        // 2.  Redirect to a failure page
        return redirect()->route('enrollment.failure.view')->with('error', 'Payment failed or was canceled. Please try again.');
    }


    public function show($courseId)
    {

        $course = Course::findOrFail($courseId);
        return view('front.payment', compact('course'));
    }

    public function showFailurePage()
    {
        return view('front.failure_page');
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
}
