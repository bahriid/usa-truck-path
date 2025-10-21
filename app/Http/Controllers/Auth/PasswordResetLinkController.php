<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->email;

        Log::info('Password reset link requested', [
            'email' => $email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        try {
            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $status = Password::sendResetLink(
                $request->only('email')
            );

            Log::info('Password reset link attempt completed', [
                'email' => $email,
                'status' => $status,
                'success' => $status == Password::RESET_LINK_SENT
            ]);

            if ($status == Password::RESET_LINK_SENT) {
                Log::info('Password reset email sent successfully', ['email' => $email]);
            } else {
                Log::warning('Password reset email failed', [
                    'email' => $email,
                    'status' => $status,
                    'translated_status' => __($status)
                ]);
            }

            return $status == Password::RESET_LINK_SENT
                        ? back()->with('status', __($status))
                        : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
        } catch (\Exception $e) {
            Log::error('Password reset link exception', [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'An error occurred while sending the password reset link. Please try again.']);
        }
    }
}
