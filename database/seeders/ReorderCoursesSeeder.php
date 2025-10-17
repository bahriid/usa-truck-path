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

        // Update Owner Operator course (ID 19 - Start Trucking Business & Owner Operator USA)
        DB::table('courses')->where('id', 19)->update([
            'created_at' => $now->copy()->subMinutes(5)
        ]);

        // Update Canadian course (ID 15)
        DB::table('courses')->where('id', 15)->update([
            'created_at' => $now->copy()->subMinutes(4)
        ]);

        // Update European course (ID 16)
        DB::table('courses')->where('id', 16)->update([
            'created_at' => $now->copy()->subMinutes(3)
        ]);

        // Update Global course (ID 17)
        DB::table('courses')->where('id', 17)->update([
            'created_at' => $now->copy()->subMinutes(2)
        ]);

        // Update Dispatcher course (ID 18)
        DB::table('courses')->where('id', 18)->update([
            'created_at' => $now->copy()->subMinutes(1)
        ]);

        // Update CLP course (ID 9 - English)
        DB::table('courses')->where('id', 9)->update([
            'created_at' => $now
        ]);

        $this->command->info('Courses reordered successfully!');
    }
}
