<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'instructor_id',
        'status',
        'course_type',
        'parent_course_id',
        'language',
        'price',
        'original_price',
        'premium_price',
        'is_active',
        'description',
        'duration',
        'start_date',
        'end_date',
        'thumbnail',
        'image',
        'level',
        'slug',
        'tags',
        'meta_title',
        'meta_description',
        'menu_name',
        'short_description',
        'telegram_chat_id',
        'is_free',
    ];

    // Define relationship with CourseContent
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
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

    /**
     * Check if course allows free tier signup.
     * All courses in the tier system should have this set to true
     * to allow users to sign up for free and access free-tier content.
     */
    public function isFree()
    {
        return $this->is_free ?? true;
    }

    /**
     * Get premium tier price.
     */
    public function getPremiumPrice()
    {
        return $this->premium_price ?? 150.00;
    }

    /**
     * Get display price (for frontend display).
     * Returns "FREE" for tier courses, actual price for paid courses.
     */
    public function getDisplayPrice()
    {
        if (($this->course_type ?? 'paid') === 'tier') {
            return 'FREE';
        }
        return '$' . number_format($this->price, 2);
    }

    /**
     * Check if course is a tier-based course.
     */
    public function isTierCourse()
    {
        return ($this->course_type ?? 'paid') === 'tier';
    }

    /**
     * Get the parent course (for language courses).
     */
    public function parentCourse()
    {
        return $this->belongsTo(Course::class, 'parent_course_id');
    }

    /**
     * Get all language variations (child courses).
     * Note: We only check status='active', NOT is_active
     * because language courses are hidden from menu (is_active=0)
     * but should still appear in the language selector.
     */
    public function languageCourses()
    {
        return $this->hasMany(Course::class, 'parent_course_id')
            ->where('status', 'active')
            ->orderBy('language');
    }

    /**
     * Check if course is a language selector course (free course with language upgrades).
     */
    public function isLanguageSelectorCourse()
    {
        return ($this->course_type ?? 'paid') === 'language_selector';
    }

    /**
     * Get language name from code.
     */
    public function getLanguageName()
    {
        $languages = [
            'en' => 'English',
            'ar' => 'Arabic',
            'fr' => 'French',
            'am' => 'Amharic',
            'ne' => 'Nepali',
            'so' => 'Somali',
        ];

        return $languages[$this->language] ?? $this->language;
    }

}
