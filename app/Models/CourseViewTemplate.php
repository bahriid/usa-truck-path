<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseViewTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'view_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the course that owns the view template
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
