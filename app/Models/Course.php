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
        'price',
        'original_price',
        'is_active',
        'description',
        'duration',
        'start_date',
        'end_date',
        'thumbnail',
        'level',
        'slug',
        'tags',
        'meta_title',
        'meta_description',
        'menu_name',
        'telegram_chat_id',
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
                'status',
                'transaction_amount',
                'transaction_id',
                'telegram_invite_link',
                'telegram_invite_generated_at',
            ])
            ->withTimestamps();
    }
      
      

}
