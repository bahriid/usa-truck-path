<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert all mentorship tier users to premium tier
        DB::table('course_user')
            ->where('subscription_tier', 'mentorship')
            ->update(['subscription_tier' => 'premium']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: Convert back to mentorship if rollback is needed
        // Note: This is not perfect as we lose information about which were originally mentorship
        // DB::table('course_user')
        //     ->where('subscription_tier', 'premium')
        //     ->update(['subscription_tier' => 'mentorship']);
    }
};
