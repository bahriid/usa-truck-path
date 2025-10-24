<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DeleteUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'hassanibrahim889@gmail.com';

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->delete();
            $this->command->info("User with email '{$email}' has been deleted.");
        } else {
            $this->command->warn("No user found with email '{$email}'.");
        }
    }
}