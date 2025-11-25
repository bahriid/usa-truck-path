<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClpLanguageCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Create the FREE CLP Language Selector Course
        $freeClpCourse = Course::create([
            'title' => 'Commercial Learner\'s Permit (CLP) - Free Intro',
            'menu_name' => 'CLP Course',
            'slug' => 'commercial-learners-permit-clp-free',
            'description' => '<p>Start your journey to becoming a professional truck driver in the USA! This FREE introductory course will teach you the basics of getting your Commercial Learner\'s Permit (CLP).</p>

            <p>In this course, you will learn:</p>
            <ul>
                <li>What is a Commercial Learner\'s Permit and why you need it</li>
                <li>Requirements for getting your CLP</li>
                <li>Documents you need to prepare</li>
                <li>How to schedule your DMV test</li>
                <li>Overview of test sections (General Knowledge, Air Brakes, Combination)</li>
            </ul>

            <p>After completing this free introduction, you can choose your preferred language and upgrade to the full course for $297 to get:</p>
            <ul>
                <li>Complete video lessons in your native language</li>
                <li>Audio guides for learning on the go</li>
                <li>Downloadable eBook with all questions and answers</li>
                <li>Real DMV test questions</li>
                <li>Access to private Telegram community support</li>
                <li>Lifetime access to course materials</li>
            </ul>',
            'category' => 'CDL Permit',
            'price' => 0.00,
            'original_price' => null,
            'status' => 'active',
            'is_active' => true,
            'course_type' => 'language_selector',
            'is_free' => true,
            'image' => null, // Admin can upload an image later
        ]);

        // Step 2: Update existing 6 CLP courses with language codes and parent_course_id
        $languageCourses = [
            9 => ['language' => 'en', 'name' => 'English'],
            10 => ['language' => 'ar', 'name' => 'Arabic'],
            11 => ['language' => 'am', 'name' => 'Amharic'],
            12 => ['language' => 'fr', 'name' => 'French'],
            13 => ['language' => 'ne', 'name' => 'Nepali'],
            14 => ['language' => 'so', 'name' => 'Somali'],
        ];

        foreach ($languageCourses as $courseId => $data) {
            $course = Course::find($courseId);

            if ($course) {
                $course->update([
                    'parent_course_id' => $freeClpCourse->id,
                    'language' => $data['language'],
                    'is_active' => false,  // Hide from menu and listings - only visible inside free course
                ]);

                $this->command->info("Updated Course ID {$courseId} ({$data['name']}) - linked to free course and hidden from menu.");
            } else {
                $this->command->warn("Course ID {$courseId} not found. Skipping.");
            }
        }

        $this->command->info('Successfully created FREE CLP course and updated language courses!');
        $this->command->info("Free CLP Course ID: {$freeClpCourse->id}");
    }
}
