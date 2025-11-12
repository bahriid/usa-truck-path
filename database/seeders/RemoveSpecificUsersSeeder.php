<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RemoveSpecificUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailsToRemove = [
            'cdlcityrecord@gmail.com',
            'amazonimpact1@gmail.com',
            'ayans8714@gmail.com',
            'sunrisetruck79@gmail.com',
            'idrisabaadir86@gmail.com',
            'cdlcityring@gmail.com',
            'buckeyetruckschool@gmail.com',
        ];

        $deletedCount = 0;

        foreach ($emailsToRemove as $email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $this->command->info("Deleting user: {$user->name} ({$email})");
                $user->delete();
                $deletedCount++;
            } else {
                $this->command->warn("User not found: {$email}");
            }
        }

        $this->command->info("\n✓ Successfully deleted {$deletedCount} user(s).");
        $this->command->info("Total emails processed: " . count($emailsToRemove));
    }
}
