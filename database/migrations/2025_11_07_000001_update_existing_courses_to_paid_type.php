<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration updates all existing courses that have course_type='tier'
     * to course_type='paid', since the new default should be paid courses.
     *
     * Only run this if you want to change existing tier courses to paid.
     * If you want to keep existing tier courses as tier, comment out this migration.
     */
    public function up(): void
    {
        // Update all courses with course_type='tier' to 'paid'
        // This ensures existing courses require payment
        DB::table('courses')
            ->where('course_type', 'tier')
            ->update(['course_type' => 'paid']);

        // If you have specific courses that should remain as tier courses,
        // you can manually update them in the admin panel after deployment.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optionally restore to tier if needed
        // DB::table('courses')->update(['course_type' => 'tier']);
    }
};
