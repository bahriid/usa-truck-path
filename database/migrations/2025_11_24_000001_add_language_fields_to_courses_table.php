<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, modify the course_type enum to include 'language_selector'
        DB::statement("ALTER TABLE courses MODIFY COLUMN course_type ENUM('tier', 'paid', 'language_selector') DEFAULT 'paid' COMMENT 'Course pricing model: tier (free signup + paid tiers), paid (one-time payment), or language_selector (free course with language-specific paid upgrades)'");

        Schema::table('courses', function (Blueprint $table) {
            // Add parent_course_id for linking language courses to the free selector course
            $table->unsignedBigInteger('parent_course_id')->nullable()->after('id');
            $table->foreign('parent_course_id')->references('id')->on('courses')->onDelete('cascade');

            // Add language code (ISO 639-1 codes: en, ar, fr, am, ne, so)
            $table->string('language', 10)->nullable()->after('course_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['parent_course_id']);
            $table->dropColumn(['parent_course_id', 'language']);
        });

        // Revert course_type enum to original values
        DB::statement("ALTER TABLE courses MODIFY COLUMN course_type ENUM('tier', 'paid') DEFAULT 'paid'");
    }
};
