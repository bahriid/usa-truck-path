<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReorderCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reorder courses by updating their created_at timestamps
        // Order: 1. Owner Operator, 2. Canadian, 3. European, 4. Global, 5. Dispatcher, 6. CLP

        $now = now();

        // Since PageController sorts by created_at DESC (newest first),
        // we need to set the newest timestamp for the first course

        // Update Owner Operator course - Should be FIRST (newest)
        DB::table('courses')
            ->where('title', 'LIKE', '%Owner Operator%')
            ->orWhere('title', 'LIKE', '%Start Trucking Business%')
            ->update(['created_at' => $now]);

        // Update Canadian course - Should be SECOND
        DB::table('courses')
            ->where('title', 'LIKE', '%Canadian%')
            ->update(['created_at' => $now->copy()->subMinutes(1)]);

        // Update European course - Should be THIRD
        DB::table('courses')
            ->where('title', 'LIKE', '%European%')
            ->update(['created_at' => $now->copy()->subMinutes(2)]);

        // Update Global course - Should be FOURTH
        DB::table('courses')
            ->where('title', 'LIKE', '%Global%')
            ->update(['created_at' => $now->copy()->subMinutes(3)]);

        // Update Dispatcher course - Should be FIFTH
        DB::table('courses')
            ->where('title', 'LIKE', '%Dispatcher%')
            ->orWhere('title', 'LIKE', '%Freight Broker%')
            ->update(['created_at' => $now->copy()->subMinutes(4)]);

        // Update CLP course - Should be LAST (oldest)
        DB::table('courses')
            ->where('title', 'LIKE', '%Commercial Learner%')
            ->orWhere('title', 'LIKE', '%CLP%')
            ->update(['created_at' => $now->copy()->subMinutes(5)]);

        $this->command->info('Courses reordered successfully!');
    }
}
