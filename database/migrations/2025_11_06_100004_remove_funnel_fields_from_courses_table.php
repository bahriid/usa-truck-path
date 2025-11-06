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
            // Drop foreign keys first
            $table->dropForeign(['paid_upgrade_course_id']);
            $table->dropForeign(['mentorship_upgrade_course_id']);

            // Drop columns
            $table->dropColumn([
                'type',
                'paid_upgrade_course_id',
                'mentorship_upgrade_course_id',
                'requires_payment',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->enum('type', ['free', 'paid', 'mentorship'])->default('paid');
            $table->boolean('requires_payment')->default(true);
            $table->foreignId('paid_upgrade_course_id')->nullable();
            $table->foreignId('mentorship_upgrade_course_id')->nullable();

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
};
