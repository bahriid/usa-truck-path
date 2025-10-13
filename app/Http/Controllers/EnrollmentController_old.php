<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Stripe\StripeClient;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class EnrollmentController extends Controller
{
    public function  showCurriculam(Request $request){
        $course = Course::find($request->course);
       return view('front.curriculam',compact('course'));
        
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
                'transaction_id'=> $session->id
            ]);


            // Use the Redirect facade to redirect to Stripe Checkout
            return Redirect::to($session->url);
        } catch (\Exception $e) {
            // Handle errors (e.g., log the error, show a message to the user)
            \Log::error('Stripe Checkout error: ' . $e->getMessage());
            return redirect()->route('enrollment.failure')->with('error', 'Failed to initiate checkout: ' . $e->getMessage()); // Use the named route
        }
    }
    // Show a simple form (Full Name, Email, Phone) to enroll
    // public function showEnrollForm($courseId)
    // {
    //     $course = Course::findOrFail($courseId);
    //     return view('front.courses.enroll-form', compact('course'));
    // }
    
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
            
            if(!$courseId){
                Log::error('Success handler: Course ID not found in session or database. Session ID: ' . $sessionId);
                return redirect()->route('enrollment.failure')->with('error', 'Course ID not found.');
            }
            
            DB::beginTransaction();
            
            try {
                // Attach with status = pending
                $user->purchasedCourses()->updateExistingPivot($courseId, [
                    'status' => 'approved',
                    'transaction_id' => $sessionId,
                ]);
                
                
            }catch (\Exception $e) {
                
                DB::rollBack();
                Log::error("Success Handler: Error updating pivot table. Session ID: $sessionId,  Error: " . $e->getMessage());
                return redirect()->route('enrollment.failure')->with('error', 'Error completing enrollment. Please contact support.');
            }
             
            DB::commit();
 

            // 8.  Redirect to a Success Page
            return redirect()->route('front.course.details',$course->slug)->with('success', 'Enrollment successful! You are now enrolled in the course.'); //  Customize this message

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
    
    public function showEnrollForm($courseId)
    {
 // If the user is not logged in, redirect to registration page.
        if (!auth()->check()) {
            return redirect()->route('register')->with('error', 'Please register or log in first to enroll.');
        }

        $course = Course::findOrFail($courseId);
        $user   = auth()->user();

        // Check if the user already has an enrollment for this course.
        $existing = $user->purchasedCourses()->where('course_id', $course->id)->first();
        if ($existing) {
            return redirect()->back()->with('info', 'You already have an enrollment request or are already enrolled.');
        }

        // Create the enrollment entry using the user's profile details.
        // Assumes the User model has 'name', 'email', and optionally 'phone'.
        $user->purchasedCourses()->attach($course->id, [
            'full_name' => $user->name,
            'email'     => $user->email,
            'phone'     => $user->phone ?? '',
            'status'    => 'pending',
        ]);

        // Redirect to payment instructions.
        return redirect()->route('front.courses.paymentInstructions', $course->id);
    }

    // Process the enrollment form
    public function processEnrollForm(Request $request, $courseId)
    {
        // dd($request->all());
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|string|max:20',
        ]);

        $course = Course::findOrFail($courseId);

        // User must be logged in
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Check if user already has a pivot row for this course
        $existing = $user->purchasedCourses()->where('course_id', $course->id)->first();
        if ($existing) {
            // Possibly they are already pending or approved
            return redirect()->back()->with('info', 'You already have an enrollment request or are already enrolled.');
        }

        // Attach with status = pending
        $user->purchasedCourses()->attach($course->id, [
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'status'    => 'pending',
        ]);

        // Redirect to payment instructions
        return redirect()->route('front.courses.paymentInstructions', $course->id);
    }

    // Show payment instructions
    public function paymentInstructions($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('front.courses.payment-instructions', compact('course'));
    }
    
    
    public function initiatePaypalPayment($courseId)
    {
        // Retrieve the course and calculate the payment amount
        $course = Course::findOrFail($courseId);
        $amount = $course->price; // Ensure your course model has a price attribute
    
        // Create a new PayPal client instance
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
    
        // Prepare the payment details
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ],
            "application_context" => [
                "cancel_url" => route('front.courses.cancel', $courseId),
                "return_url" => route('front.courses.success', $courseId)
            ]
        ]);
        
        $user = auth()->user();
        // Check if the user already has an enrollment for this course.
        $existing = $user->purchasedCourses()->where('course_id', $course->id)->first();
        if ($existing) {
            return redirect()->back()->with('info', 'You already have an enrollment request or are already enrolled.');
        }

    
        if (isset($response['id']) && $response['id'] != null) {
            // Redirect user to approve the payment
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
    
            return redirect()
                ->route('front.courses.paymentInstructions', $courseId)
                ->with('error', 'Something went wrong while processing your payment.');
        } else {
            return redirect()
                ->route('front.courses.paymentInstructions', $courseId)
                ->with('error', 'Something went wrong while processing your payment.');
        }
    }
    
    public function handlePaypalSuccess(Request $request, $courseId)
{
    $provider = new PayPalClient;
    $provider->setApiCredentials(config('paypal'));
    $provider->getAccessToken();

    // Capture the order using the token provided in the query parameters
    $response = $provider->capturePaymentOrder($request->token);

    if (isset($response['status']) && $response['status'] === 'COMPLETED') {
        // Update your enrollment record as paid or approved.
        $user = auth()->user();
        $course = Course::where('id', $courseId)->firstOrFail();                
        // Create the enrollment entry using the user's profile details.
        // Assumes the User model has 'name', 'email', and optionally 'phone'.
        $user->purchasedCourses()->attach($course->id, [
            'full_name' => $user->name,
            'email'     => $user->email,
            'phone'     => $user->phone ?? '',
            'status'    => 'approved',
            'transaction_id' => $response['id']
        ]);

        return redirect()->route('front.course.details', $course->slug)
            ->with('success', 'Your payment was successful, and you are now enrolled.');
    } else {
        return redirect()->route('front.courses.paymentInstructions', $courseId)
            ->with('error', 'Payment was not successful. Please try again.');
    }
}

public function handlePaypalCancel($courseId)
{
    return redirect()->route('front.courses.paymentInstructions', $courseId)
        ->with('info', 'Payment was cancelled.');
}


}
