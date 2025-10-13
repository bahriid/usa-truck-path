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
        return view('auth.register',['courseId' => $courseId]);
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

    // public function store(Request $request): RedirectResponse
    // {
    //     // dd($request->all());
    //     $course = Course::find($request->course_id);
    //     $price = $course->price;
        
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //         'stripeToken' => ['required', 'string'],
    //         'course_id' => ['required', 'integer', 'exists:courses,id'], // Ensure the course exists
             
    //     ]);

    //     Stripe::setApiKey(env('STRIPE_SECRET'));

    //     DB::beginTransaction();

    //     try {
    //         $charge = Charge::create([
    //             'amount' =>  $price * 100, // Use the price from the form (in cents)
    //             'currency' => 'usd', // Adjust currency as needed
    //             'source' => $request->stripeToken,
    //             'description' => 'Course Purchase for ' . $request->email . ' - Course ID: ' . $request->course_id,
    //         ]);

    //         if ($charge->status === 'succeeded') {
    //             $user = User::create([
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'password' => Hash::make($request->password),
    //             ]);

    //             event(new Registered($user));

    //             Auth::login($user);

                

    //             // Attach the course to the user with 'approved' status immediately
    //             $user->purchasedCourses()->attach($course->id, [
    //                 'full_name' => $user->name,
    //                 'email' => $user->email,
    //                 'phone' => $user->phone ?? null, // Assuming you might have phone in your registration form
    //                 'status' => 'approved', // Mark as approved directly upon successful payment
    //                 'transaction_id' => $charge->id, // Use Stripe's charge ID as transaction ID
    //             ]);

    //             DB::commit();

    //             // return redirect()->route('front.course.details', $course->slug)->with('success', 'Registration and Enrollment successful!');
    //                             return redirect()->route('course.curriculam', $course->id)->with('success', 'Registration and Enrollment successful!');

    //         } else {
    //             DB::rollBack();
    //             return redirect()->back()->withErrors(['payment' => 'Payment processing failed. Please try again.']);
    //         }
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('Stripe Registration and Enrollment Error: ' . $e->getMessage());
    //         return redirect()->back()->withErrors(['payment' => 'Failed to process payment and enrollment. Please check your card details or try again later.']);
    //     }
    // }
    
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $course = Course::find($request->course_id);
        $price = $course->price;
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'stripeToken' => ['required', 'string'],
            'course_id' => ['required', 'integer', 'exists:courses,id'], // Ensure the course exists
             
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        DB::beginTransaction();

        try {
            $charge = Charge::create([
                'amount' => $price * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken, // ✅ Fix applied here
                'description' => 'Course Purchase for ' . $request->email . ' - Course ID: ' . $request->course_id,
            ]);
        
            if ($charge->status === 'succeeded') {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
        
                event(new Registered($user));
                Auth::login($user);
        
                $user->purchasedCourses()->attach($course->id, [
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? null,
                    'status' => 'approved',
                    'transaction_id' => $charge->id,
                ]);
        
                DB::commit();
        
                return redirect()->route('course.curriculam', $course->id)
                                 ->with('success', 'Registration and Enrollment successful!');
            } else {
                DB::rollBack();
                return redirect()->back()->withErrors(['payment' => 'Payment processing failed. Please try again.']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Stripe Registration and Enrollment Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['payment' => 'Failed to process payment and enrollment. Please check your card details or try again later.']);
        }
        
    }
    
}
