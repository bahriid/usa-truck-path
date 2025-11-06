<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EnrollmentService
{
    protected TelegramService $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Enroll a user in a course with pending status
     *
     * @param User $user
     * @param Course $course
     * @param string $transactionId
     * @param string $status
     * @return void
     */
    public function enrollUser(User $user, Course $course, string $transactionId, string $status = 'pending', string $tier = 'free'): void
    {
        // Check if user is already enrolled
        if ($this->isUserEnrolled($user, $course)) {
            throw new \Exception('You already have an enrollment request or are already enrolled.');
        }

        $user->purchasedCourses()->attach($course->id, [
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'country' => $user->country,
            'status' => $status,
            'subscription_tier' => $tier,
            'transaction_id' => $transactionId,
        ]);
    }

    /**
     * Auto-enroll user in free tier (no payment, immediate approval).
     *
     * @param User $user
     * @param Course $course
     * @return void
     */
    public function autoEnrollInFreeTier(User $user, Course $course): void
    {
        // Check if already enrolled
        if ($this->isUserEnrolled($user, $course)) {
            return;
        }

        // Enroll with approved status and free tier
        $user->purchasedCourses()->attach($course->id, [
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'country' => $user->country,
            'status' => 'approved',
            'subscription_tier' => 'free',
            'transaction_id' => 'free_enrollment_' . time(),
            'transaction_amount' => 0,
        ]);

        // Generate Telegram invite if course has chat
        if ($course->telegram_chat_id) {
            $this->generateTelegramInvite($user, $course);
        }
    }

    /**
     * Upgrade user's subscription tier in a course.
     *
     * @param User $user
     * @param Course $course
     * @param string $newTier
     * @param string $transactionId
     * @param float $amount
     * @return void
     */
    public function upgradeTier(User $user, Course $course, string $newTier, string $transactionId, float $amount): void
    {
        $user->purchasedCourses()->updateExistingPivot($course->id, [
            'subscription_tier' => $newTier,
            'transaction_id' => $transactionId,
            'transaction_amount' => $amount,
            'status' => 'approved',
        ]);
    }

    /**
     * Approve enrollment and update transaction amount
     *
     * @param User $user
     * @param Course $course
     * @param string $transactionId
     * @param float $transactionAmount
     * @return void
     */
    public function approveEnrollment(User $user, Course $course, string $transactionId, float $transactionAmount): void
    {
        $user->purchasedCourses()->updateExistingPivot($course->id, [
            'status' => 'approved',
            'transaction_amount' => $transactionAmount,
            'transaction_id' => $transactionId,
        ]);
    }

    /**
     * Check if user is already enrolled in a course
     *
     * @param User $user
     * @param Course $course
     * @return bool
     */
    public function isUserEnrolled(User $user, Course $course): bool
    {
        return $user->purchasedCourses()->where('course_id', $course->id)->exists();
    }

    /**
     * Get user's enrollment for a specific course
     *
     * @param User $user
     * @param Course $course
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getUserEnrollment(User $user, Course $course)
    {
        return $user->purchasedCourses()->where('course_id', $course->id)->first();
    }

    /**
     * Generate and store Telegram invite link for an enrollment
     *
     * @param User $user
     * @param Course $course
     * @return string|null Returns the invite link or null on failure
     */
    public function generateTelegramInvite(User $user, Course $course): ?string
    {
        // Check if course has Telegram integration
        if (!$course->telegram_chat_id) {
            Log::warning("Course {$course->id} does not have a Telegram chat ID configured");

            return null;
        }

        // Get enrollment
        $enrollment = $this->getUserEnrollment($user, $course);

        if (!$enrollment) {
            Log::warning("User {$user->id} is not enrolled in course {$course->id}");

            return null;
        }

        // Check if enrollment is approved
        if ($enrollment->pivot->status !== 'approved') {
            Log::warning("User {$user->id} enrollment in course {$course->id} is not approved");

            return null;
        }

        // Check if invite link already exists
        if ($enrollment->pivot->telegram_invite_link) {
            return $enrollment->pivot->telegram_invite_link;
        }

        // Create new invite link
        $inviteData = $this->telegramService->createChatInviteLink(
            $course->telegram_chat_id,
            1, // member_limit: 1 for one-time use
            null, // no expiration
            "Invite for {$user->name}"
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

            return $inviteData['invite_link'];
        }

        Log::error("Failed to generate Telegram invite link for user {$user->id} in course {$course->id}");

        return null;
    }

    /**
     * Send admin notification email about new purchase
     *
     * @param User $user
     * @param Course $course
     * @param string|null $adminEmail
     * @return void
     */
    public function sendAdminNotification(User $user, Course $course, ?string $adminEmail = null): void
    {
        $email = $adminEmail ?? config('mail.admin_email', 'abaadiracademy@gmail.com');

        try {
            Mail::to($email)->send(new \App\Mail\NewCoursePurchaseNotification($user, $course));
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification: '.$e->getMessage());
        }
    }

    /**
     * Complete enrollment process: approve, notify admin, generate Telegram invite
     *
     * @param User $user
     * @param Course $course
     * @param string $transactionId
     * @param float $transactionAmount
     * @return void
     */
    public function completeEnrollment(User $user, Course $course, string $transactionId, float $transactionAmount): void
    {
        // Approve enrollment
        $this->approveEnrollment($user, $course, $transactionId, $transactionAmount);

        // Send admin notification
        $this->sendAdminNotification($user, $course);

        // Generate Telegram invite if configured
        if ($course->telegram_chat_id) {
            $this->generateTelegramInvite($user, $course);
        }
    }
}
