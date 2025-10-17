<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateCoursePricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update all courses with price = 160 and original_price = 497
        DB::table('courses')->update([
            'price' => 160.00,
            'original_price' => 497.00
        ]);

        $this->command->info('All course prices updated successfully!');
        $this->command->info('Price: $160.00');
        $this->command->info('Original Price: $497.00');
    }
}
