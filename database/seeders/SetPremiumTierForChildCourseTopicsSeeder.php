<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetPremiumTierForChildCourseTopicsSeeder extends Seeder
{
    /**
     * Set all topics to 'premium' tier for courses that have a parent_course_id.
     * These are child courses (language-specific courses) where all content should be premium.
     */
    public function run(): void
    {
        // Get all course IDs that have a parent (child courses)
        $childCourseIds = Course::whereNotNull('parent_course_id')->pluck('id');

        if ($childCourseIds->isEmpty()) {
            $this->command->info('No child courses found.');
            return;
        }

        // Get all chapter IDs for those child courses
        $chapterIds = DB::table('chapters')
            ->whereIn('course_id', $childCourseIds)
            ->pluck('id');

        if ($chapterIds->isEmpty()) {
            $this->command->info('No chapters found for child courses.');
            return;
        }

        // Update all topics in those chapters to premium tier
        $updatedCount = Topic::whereIn('chapter_id', $chapterIds)
            ->update(['tier' => 'premium']);

        $this->command->info("Updated {$updatedCount} topics to premium tier for child courses.");
    }
}
