<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update column to support longer region codes (GLOBAL = 6 chars)
        Schema::table('courses', function (Blueprint $table) {
            $table->string('country_code', 10)->nullable()->change();
        });

        // Update existing courses with region codes based on their slug
        DB::table('courses')->where('slug', 'like', '%canada%')->update(['country_code' => 'CA']);
        DB::table('courses')->where('slug', 'like', '%europe%')->update(['country_code' => 'EU']);
        DB::table('courses')->where('slug', 'like', '%global%')->update(['country_code' => 'GLOBAL']);

        // Set US courses (those without canada/europe/global in slug and not language courses)
        DB::table('courses')
            ->whereNull('country_code')
            ->whereNull('parent_course_id')
            ->where('slug', 'not like', '%canada%')
            ->where('slug', 'not like', '%europe%')
            ->where('slug', 'not like', '%global%')
            ->update(['country_code' => 'US']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string('country_code', 2)->nullable()->change();
        });
    }
};
