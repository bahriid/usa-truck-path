<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use ReturnTypeWillChange;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class EnrollmentController extends Controller
{

    public function  showCurriculam(Request $request)
    {
        $course = Course::find($request->course);

        // Generate Telegram invite link if user is enrolled and hasn't got one yet
        if (auth()->check()) {
            $user = auth()->user();
            $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();

            if ($enrollment && $enrollment->pivot->status === 'approved' && $course->telegram_chat_id) {
                // Check if link doesn't exist or needs regeneration
                if (!$enrollment->pivot->telegram_invite_link) {
                    $telegramService = new \App\Services\TelegramService();
                    $inviteData = $telegramService->createChatInviteLink(
                        $course->telegram_chat_id,
                        1, // member_limit: 1 for one-time use
                        null, // no expiration
                        "Invite for {$user->name}" // link name
                    );

                    if ($inviteData && isset($inviteData['invite_link'])) {
                        // Store the generated link
                        DB::table('course_user')
                            ->where('user_id', $user->id)
                            ->where('course_id', $course->id)
                            ->update([
                                'telegram_invite_link' => $inviteData['invite_link'],
                                'telegram_invite_generated_at' => now(),
                            ]);

                        // Refresh enrollment data
                        $enrollment = $user->purchasedCourses()->where('course_id', $course->id)->first();
                    }
                }
            }
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
            'price'     => 'required|numeric',
        ]);

        $course = Course::findOrFail($request->course_id);
        $price = $request->price;

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            $session = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $course->title,
                            ],
                            'unit_amount' => $price * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',

                'success_url' => url('/enrollment/success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => url('/enrollment/failure'),
            ]);

            // dd($session);  // Add this line for debugging
            // // Log the session ID
            // Log::info('Stripe Checkout Session ID: ' . $session->id);

            // Check if user already has a pivot row for this course
            $existing = $user->purchasedCourses()->where('course_id', $course->id)->first();
            if ($existing) {
                // Possibly they are already pending or approved
                return redirect()->back()->with('success', 'You already have an enrollment request or are already enrolled.');
            }

            // Attach with status = pending
            $user->purchasedCourses()->attach($course->id, [
                'full_name' => $user->name,
                'email'     => $user->email,
                'phone'     => $user->phone,
                'status'    => 'pending',
                'transaction_id' => $session->id
            ]);


            // Use the Redirect facade to redirect to Stripe Checkout
            return Redirect::to($session->url);
        } catch (\Exception $e) {
            // Handle errors (e.g., log the error, show a message to the user)
            \Log::error('Stripe Checkout error: ' . $e->getMessage());
            return redirect()->route('enrollment.failure')->with('error', 'Failed to initiate checkout: ' . $e->getMessage()); // Use the named route
        }
    }

    public function handleSuccessfulPayment(Request $request)
    {
        // User must be logged in
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // 1.  Get the Session ID
        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            dd($sessionId);
            //  Handle the case where session_id is missing (shouldn't happen, but be defensive)
            Log::error('Success handler: Session ID is missing.');
            return redirect()->route('enrollment.failure')->with('error', 'Invalid payment session.');
        }


        $stripe = new StripeClient(env('STRIPE_SECRET'));

        try {
            // 2.  Retrieve the Stripe Checkout Session
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            // 3.  Verify Payment Status (CRITICAL)
            if ($session->payment_status !== 'paid') {
                Log::warning('Success handler: Payment not paid. Session ID: ' . $sessionId);
                return redirect()->route('enrollment.failure')->with('error', 'Payment was not completed successfully.');
            }


            // 4.  Get the Order (or Course Enrollment) from your database
            //  You should have stored the session_id in your database when you created the Checkout Session.

            // 6.  Fulfill the Order (Enroll the user in the course, update database)

            $courseId = null;

            if (!$courseId) {
                //If not in metadata, try to get it from your database, you might have stored it there.
                $order = DB::table('course_user')->where('transaction_id', $sessionId)->first();
                if ($order) {
                    $courseId = $order->course_id;
                }
            }

            $course = Course::find($courseId);

            if (!$courseId) {
                Log::error('Success handler: Course ID not found in session or database. Session ID: ' . $sessionId);
                return redirect()->route('enrollment.failure')->with('error', 'Course ID not found.');
            }

            DB::beginTransaction();

            try {
                // Attach with status = pending
                $user->purchasedCourses()->updateExistingPivot($courseId, [
                    'status' => 'approved',
                    'transaction_amount'=>$course->price,
                    'transaction_id' => $sessionId,
                ]);
            } catch (\Exception $e) {

                DB::rollBack();
                Log::error("Success Handler: Error updating pivot table. Session ID: $sessionId,  Error: " . $e->getMessage());
                return redirect()->route('enrollment.failure')->with('error', 'Error completing enrollment. Please contact support.');
            }

            DB::commit();
            $adminEmail = 'abaadiracademy@gmail.com';
            


            Mail::to($adminEmail)->send(new \App\Mail\NewCoursePurchaseNotification($user, $course));


            // 8.  Redirect to a Success Page
            return redirect()->route('front.course.details', $course->slug)->with('success', 'Enrollment successful! You are now enrolled in the course.'); //  Customize this message

        } catch (\Exception $e) {
            // 9.  Handle Errors (Stripe API errors, etc.)
            Log::error('Error in handleSuccessfulPayment: ' . $e->getMessage() . ' Session ID: ' . $sessionId);
            return redirect()->route('enrollment.failure')->with('error', 'Failed to process payment. Please contact support.'); //  Use the named route
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

        // Find the enrollment
        $enrollment = $user->purchasedCourses()->where('course_id', $courseId)->first();

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

    // Show a simple form (Full Name, Email, Phone) to enroll
    // public function showEnrollForm($courseId)
    // {
    //     $course = Course::findOrFail($courseId);
    //     return view('front.courses.enroll-form', compact('course'));
    // }

    // Process the enrollment form
    // public function processEnrollForm(Request $request, $courseId)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'full_name' => 'required|string|max:255',
    //         'email'     => 'required|email',
    //         'phone'     => 'required|string|max:20',
    //     ]);

    //     $course = Course::findOrFail($courseId);

    //     // User must be logged in
    //     $user = auth()->user();
    //     if (!$user) {
    //         return redirect()->route('login')->with('error', 'Please log in first.');
    //     }

    //     // Check if user already has a pivot row for this course
    //     $existing = $user->purchasedCourses()->where('course_id', $course->id)->first();
    //     if ($existing) {
    //         // Possibly they are already pending or approved
    //         return redirect()->back()->with('info', 'You already have an enrollment request or are already enrolled.');
    //     }

    //     // Attach with status = pending
    //     $user->purchasedCourses()->attach($course->id, [
    //         'full_name' => $request->full_name,
    //         'email'     => $request->email,
    //         'phone'     => $request->phone,
    //         'status'    => 'pending',
    //     ]);

    //     // Redirect to payment instructions
    //     return redirect()->route('front.courses.paymentInstructions', $course->id);
    // }

    // Show payment instructions
    // public function paymentInstructions($courseId)
    // {
    //     $course = Course::findOrFail($courseId);
    //     return view('front.courses.payment-instructions', compact('course'));
    // }

    // public function store(Request $request)
    // {
    //     // $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET '));
    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     $charge =  Charge::create([
    //         'amount' => $request->price * 100,
    //         'currency' => 'usd',
    //         'source' => $request->stripeToken,
    //         'description' => 'payment from passyourpermit.com'
    //     ]);

    //     return back()->with('success', 'payment done successfully');
    //     // dd($charge);
    // }


    // public function payment(Request $request)
    // {
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    //     $successUrl = route('stripe.payment') . '?session_id={CHECKOUT_SESSION_ID}';

    //     $response =  $stripe->checkout->sessions->create([
    //         'success_url' => $successUrl,
    //         'line_items' => [
    //             [
    //                 'price_data' => [
    //                     'currency' => 'usd',
    //                     'product_data' => ['name' => 'course'],
    //                     'unit_amount' => $request->price * 100,
    //                 ],
    //                 'quantity' => 1,
    //             ],
    //         ],
    //         'mode' => 'payment',
    //     ]);

    //     return redirect($response['url']);
    // }

    // public function success(Request $request)
    // {
    //     dd($request->all());
    // }
}
