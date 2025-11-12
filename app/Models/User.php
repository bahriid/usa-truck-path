<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'country',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function purchasedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_user')
            ->withPivot([
                'full_name',
                'email',
                'phone',
                'country',
                'status',
                'subscription_tier',
                'transaction_amount',
                'transaction_id',
                'telegram_invite_link',
                'telegram_invite_generated_at',
            ])
            ->withTimestamps();
    }

    // Alias for purchasedCourses (used in new funnel logic)
    public function courses()
    {
        return $this->purchasedCourses();
    }

    // Helper to check if user has purchased a specific course
    public function hasPurchasedCourse($courseId)
    {
        return $this->purchasedCourses()
            ->wherePivot('status', 'pending')
            ->where('course_id', $courseId)->exists();
    }

    public function hasApprovedCourse($courseId)
    {
        return $this->purchasedCourses()
            ->wherePivot('status', 'approved')
            ->where('course_id', $courseId)
            ->exists();
    }

    /**
     * Check if user can access a course.
     */
    public function canAccessCourse($courseId)
    {
        $enrollment = $this->courses()
            ->where('course_id', $courseId)
            ->where('status', 'approved')
            ->first();

        return $enrollment !== null;
    }

    /**
     * Get user's subscription tier for a course.
     *
     * @return string|null 'free', 'premium', or null
     */
    public function getSubscriptionTier($courseId)
    {
        $enrollment = $this->courses()
            ->where('course_id', $courseId)
            ->first();

        return $enrollment ? $enrollment->pivot->subscription_tier : null;
    }

    /**
     * Check if user can access a specific topic based on their subscription tier.
     */
    public function canAccessTopic($topic, $courseId)
    {
        $userTier = $this->getSubscriptionTier($courseId);

        if (!$userTier) {
            return false;
        }

        // Tier hierarchy: premium > free
        $tierHierarchy = [
            'free' => ['free'],
            'premium' => ['free', 'premium'],
        ];

        return in_array($topic->tier, $tierHierarchy[$userTier] ?? []);
    }

    /**
     * Get user's enrollment status for a course.
     *
     * @return string|null 'approved', 'pending', 'rejected', or null
     */
    public function getEnrollmentStatus($courseId)
    {
        $enrollment = $this->courses()
            ->where('course_id', $courseId)
            ->first();

        return $enrollment ? $enrollment->pivot->status : null;
    }

    /**
     * Check if user is enrolled in a course (any status).
     */
    public function isEnrolledIn($courseId)
    {
        return $this->courses()->where('course_id', $courseId)->exists();
    }

    /**
     * Get the user's enrolled courses.
     */
    public function getEnrolledCourses()
    {
        return $this->courses()
            ->where('course_user.status', 'approved')
            ->get();
    }
}
