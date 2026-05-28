<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Backfill migration: Course model lists `order`, `start_date`, `end_date`,
 * `thumbnail`, `level`, `short_description` as fillable, but no migration
 * in the repo creates them — the dev's local DB has them from somewhere
 * else. App code in PageController and admin views reads/writes these.
 *
 * All guards are `hasColumn` so the migration is idempotent on any DB.
 *
 * Early timestamp so this runs before later course-* migrations that may
 * implicitly assume these columns exist.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (!Schema::hasColumn('courses', 'order')) {
                $table->integer('order')->nullable();
            }
            if (!Schema::hasColumn('courses', 'start_date')) {
                $table->date('start_date')->nullable();
            }
            if (!Schema::hasColumn('courses', 'end_date')) {
                $table->date('end_date')->nullable();
            }
            if (!Schema::hasColumn('courses', 'thumbnail')) {
                $table->string('thumbnail')->nullable();
            }
            if (!Schema::hasColumn('courses', 'level')) {
                $table->string('level')->nullable();
            }
            if (!Schema::hasColumn('courses', 'short_description')) {
                $table->text('short_description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            foreach (['order', 'start_date', 'end_date', 'thumbnail', 'level', 'short_description'] as $col) {
                if (Schema::hasColumn('courses', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
