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
        'is_active',
        'description', // If applicable
        'duration', // If applicable
        'start_date', // If applicable
        'end_date', // If applicable
        'thumbnail', // If applicable
        'level', // If applicable
         'slug',
         'tags',
         'meta_title',
         'meta_description',
         'menu_name'
    
    ];
      // Define relationship with CourseContent
      public function chapters()
      {
          return $this->hasMany(Chapter::class);
      }
      public function students()
      {
          return $this->belongsToMany(User::class, 'course_user')
                      ->withTimestamps();
      }
      
      

}
