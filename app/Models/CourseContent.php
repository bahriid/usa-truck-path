<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'type',
        'file_path',
        'external_link',
        'content_text',
        'meta',
        'order',
    ];

    // Define the inverse relationship to Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
