<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Backfill migration: `phone` is used in app/Models/User.php, EnrollmentController,
 * RegisteredUserController, PageController, etc., and `2025_11_06_000001_add_country_to_users_table`
 * tries to place `country` after `phone`. But no migration in the repo creates
 * the column — the dev's local DB has it from somewhere else. This migration
 * closes that gap.
 *
 * `hasColumn` guard makes this safe to run on any DB where the column already
 * exists.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
