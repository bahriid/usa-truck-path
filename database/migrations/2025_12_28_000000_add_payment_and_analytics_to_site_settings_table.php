<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Backfill migration: SiteSetting model lists `google_analytics_code`,
 * `row_id`, `cash_app`, `zelle` as fillable, and the next migration
 * (`2025_12_29_160056_add_geo_filtering_to_site_settings_table`) places its
 * new column `after('zelle')`. But no migration in the repo ever created
 * those columns — the dev's local DB has them from somewhere else.
 *
 * All guards are `hasColumn` so the migration is idempotent on any DB.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('site_settings', 'google_analytics_code')) {
                $table->text('google_analytics_code')->nullable();
            }
            if (!Schema::hasColumn('site_settings', 'row_id')) {
                $table->string('row_id', 255)->nullable();
            }
            if (!Schema::hasColumn('site_settings', 'cash_app')) {
                $table->string('cash_app', 255)->nullable();
            }
            if (!Schema::hasColumn('site_settings', 'zelle')) {
                $table->string('zelle', 255)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            foreach (['google_analytics_code', 'row_id', 'cash_app', 'zelle'] as $col) {
                if (Schema::hasColumn('site_settings', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
