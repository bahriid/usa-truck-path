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

        return view('new-design.auth.register', ['courseId' => $courseId]);
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

        // Send welcome email (non-blocking - don't fail registration if email fails)
        try {
            Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
        } catch (\Exception $e) {
            Log::warning('Failed to send welcome email: ' . $e->getMessage());
        }

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
        // Validate input (simplified - no payment fields)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'course_id' => ['nullable', 'integer', 'exists:courses,id'], // Optional course ID
        ]);

        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => strtolower(trim($request->email)),
                'phone' => $request->phone ?? '',
                'country' => $request->country ?? '',
                'password' => Hash::make($request->password),
            ]);

            // Fire registration event (sends verification email if enabled)
            event(new Registered($user));

            // Log user in
            Auth::login($user);

            // Auto-enroll in the free tier course or language_selector course they clicked (if provided)
            if ($request->course_id) {
                $course = Course::find($request->course_id);

                // Auto-enroll if it's a tier-based course or language_selector course (free signup)
                if ($course && ($course->isTierCourse() || $course->isLanguageSelectorCourse())) {
                    $this->enrollInFreeCourse($user, $request->course_id);
                }
                // For paid courses, don't auto-enroll - they'll need to complete payment
            }

            // Send welcome email (non-blocking - don't fail registration if email fails)
            try {
                Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($user));
            } catch (\Exception $e) {
                Log::warning('Failed to send welcome email: ' . $e->getMessage());
            }

            DB::commit();

            // Determine redirect based on course type
            if ($request->course_id) {
                $course = Course::find($request->course_id);

                if ($course) {
                    // Redirect to curriculum page
                    return redirect()->route('course.curriculam', ['course' => $course->id])
                        ->with('success', 'Registration successful! Welcome to USA Truck Path.');
                }
            }

            // No course specified, redirect to dashboard
            return redirect()->route('dashboard')
                ->with('success', 'Welcome to USA Truck Path!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration Error: '.$e->getMessage());

            return redirect()->back()
                ->withErrors(['error' => 'Failed to complete registration. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Auto-enroll user in a course with free tier.
     */
    protected function enrollInFreeCourse(User $user, int $courseId): void
    {
        $course = Course::find($courseId);

        if (!$course) {
            Log::error("Course ID {$courseId} not found during registration");
            return;
        }

        // Use enrollment service to handle enrollment with free tier
        $enrollmentService = app(\App\Services\EnrollmentService::class);
        $enrollmentService->autoEnrollInFreeTier($user, $course);
    }
}
