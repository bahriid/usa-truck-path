<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Course type
            $table->enum('type', ['free', 'paid', 'mentorship'])
                  ->default('paid')
                  ->after('status');

            $table->boolean('is_free')
                  ->default(false)
                  ->after('type')
                  ->comment('Quick check for free courses');

            $table->boolean('requires_payment')
                  ->default(true)
                  ->after('is_free')
                  ->comment('Whether course requires payment before access');

            // Funnel relationships (key to multi-funnel system)
            $table->foreignId('paid_upgrade_course_id')
                  ->nullable()
                  ->after('requires_payment')
                  ->comment('ID of paid course to upgrade to (for free courses)');

            $table->foreignId('mentorship_upgrade_course_id')
                  ->nullable()
                  ->after('paid_upgrade_course_id')
                  ->comment('ID of mentorship course to upgrade to (for free/paid courses)');

            // Add foreign key constraints
            $table->foreign('paid_upgrade_course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('set null');

            $table->foreign('mentorship_upgrade_course_id')
                  ->references('id')
                  ->on('courses')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['paid_upgrade_course_id']);
            $table->dropForeign(['mentorship_upgrade_course_id']);

            // Drop columns
            $table->dropColumn([
                'type',
                'is_free',
                'requires_payment',
                'paid_upgrade_course_id',
                'mentorship_upgrade_course_id',
            ]);
        });
    }
};
