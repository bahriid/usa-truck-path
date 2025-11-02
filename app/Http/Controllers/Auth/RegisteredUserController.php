<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Stripe\Charge;
use Stripe\Stripe;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $courseId = $request->query('course_id');

        return view('auth.register', ['courseId' => $courseId]);
    }

    /**
     * Display the standalone registration view (without payment).
     */
    public function createStandalone(): View
    {
        return view('auth.register-standalone');
    }

    /**
     * Handle standalone registration (without payment).
     */
    public function storeStandalone(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower(trim($request->email)),
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        // Send welcome email
        Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));

        return redirect()->route('front.home')
            ->with('success', 'Registration successful! Welcome to USATRUCKPATH.');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'stripeToken' => ['required', 'string'],
    //     ]);

    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     try {
    //         $charge = Charge::create([
    //             'amount' => 5000, // Example: Registration fee of $50.00 (in cents) - ADJUST THIS!
    //             'currency' => 'usd', // Adjust currency as needed
    //             'source' => $request->stripeToken,
    //             'description' => 'Registration Fee for ' . $request->email,
    //         ]);

    //         if ($charge->status === 'succeeded') {
    //             $user = User::create([
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'password' => Hash::make($request->password),
    //             ]);

    //             event(new Registered($user));

    //             Auth::login($user);


    //             return redirect(route('dashboard', absolute: false));
    //         } else {
    //             // Payment failed
    //             return redirect()->back()->withErrors(['payment' => 'Payment processing failed. Please try again.']);
    //         }
    //     } catch (\Exception $e) {
    //         // Handle Stripe API errors or other exceptions
    //         \Log::error('Stripe Registration Payment Error: ' . $e->getMessage());
    //         return redirect()->back()->withErrors(['payment' => 'Failed to process payment. Please check your card details or try again later.']);
    //     }
    // }

    public function store(Request $request): RedirectResponse
    {
        $course = Course::findOrFail($request->course_id);
        $price = $course->price;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'integer'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'stripeToken' => ['required', 'string'],
        ]);

        DB::beginTransaction();

        try {
            // Inject services
            $paymentService = app(\App\Services\PaymentService::class);
            $enrollmentService = app(\App\Services\EnrollmentService::class);

            // Process payment
            $transactionId = $paymentService->processCharge(
                $price,
                $request->stripeToken,
                'Course Purchase for '.$request->email.' - Course ID: '.$request->course_id
            );

            // Create user account
            $user = User::create([
                'name' => $request->name,
                'email' => strtolower(trim($request->email)),
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            Auth::login($user);

            // Send welcome email
            Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));

            // Enroll user in course with approved status
            $user->purchasedCourses()->attach($course->id, [
                'full_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? null,
                'status' => 'approved',
                'transaction_amount' => $price,
                'transaction_id' => $transactionId,
            ]);

            DB::commit();

            // Send admin notification and generate Telegram invite
            $enrollmentService->sendAdminNotification($user, $course);

            if ($course->telegram_chat_id) {
                $enrollmentService->generateTelegramInvite($user, $course);
            }

            return redirect()->route('course.curriculam', $course->id)
                ->with('success', 'Registration and Enrollment successful!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration and Enrollment Error: '.$e->getMessage());

            return redirect()->back()->withErrors(['payment' => 'Failed to process registration and enrollment. Please try again later.']);
        }
    }
}
