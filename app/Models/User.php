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
        'phone'
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
                'status',
                'transaction_amount',
                'transaction_id',
                'telegram_invite_link',
                'telegram_invite_generated_at',
            ])
            ->withTimestamps();
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
}
