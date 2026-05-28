<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Backfill migration: app code (controllers, models, services, seeders, blade
 * views) all read/write `course_user.transaction_id`, but no migration in the
 * original repo created the column. Result: a fresh `migrate` fails on the
 * later `2025_10_13_000001_update_telegram_fields` migration, which references
 * the missing column.
 *
 * `hasColumn` guard makes this safe on any existing DB where the column was
 * created some other way.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            if (!Schema::hasColumn('course_user', 'transaction_id')) {
                $table->string('transaction_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            if (Schema::hasColumn('course_user', 'transaction_id')) {
                $table->dropColumn('transaction_id');
            }
        });
    }
};
