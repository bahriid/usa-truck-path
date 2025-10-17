<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateCoursePrices297Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update all courses with price = 297 and original_price = 597
        DB::table('courses')->update([
            'price' => 297.00,
            'original_price' => 597.00
        ]);

        $this->command->info('All course prices updated successfully!');
        $this->command->info('Price: $297.00');
        $this->command->info('Original Price: $597.00');
    }
}
