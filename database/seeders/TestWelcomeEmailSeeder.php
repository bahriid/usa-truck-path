<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TestWelcomeEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user object (not saved to database)
        $testUser = new User([
            'name' => 'Bahri',
            'email' => 'hello@bahri.id',
        ]);

        // Send welcome email to test address
        Mail::to('hello@bahri.id')->send(new \App\Mail\WelcomeEmail($testUser));

        $this->command->info('Test welcome email sent successfully to hello@bahri.id');
        $this->command->info('Please check your inbox!');
    }
}
