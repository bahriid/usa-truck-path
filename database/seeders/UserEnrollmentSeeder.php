<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Course;

class UserEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update the user
        $user = User::updateOrCreate(
            ['email' => 'aribahri15@gmail.com'],
            [
                'name' => 'Bahri',
                'password' => Hash::make('password'),
                'phone' => null,
                'country' => null,
                'email_verified_at' => now(), // Verify email automatically
            ]
        );

        // Get all courses
        $courses = Course::all();

        if ($courses->isEmpty()) {
            $this->command->warn('No courses found in the database. Please seed courses first.');
            return;
        }

        // Enroll user in all courses with approved status
        foreach ($courses as $course) {
            // Check if already enrolled
            if ($user->isEnrolledIn($course->id)) {
                $this->command->info("User already enrolled in: {$course->title}");
                continue;
            }

            // Enroll the user
            $user->purchasedCourses()->attach($course->id, [
                'full_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'country' => $user->country,
                'status' => 'approved', // Automatically approved
                'subscription_tier' => 'premium', // Highest tier - access to all content
                'transaction_amount' => $course->price ?? 0,
                'transaction_id' => 'SEEDER_MANUAL_ENROLL_' . time() . '_' . $course->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info("Enrolled user in: {$course->title}");
        }

        $this->command->info("\nSuccessfully enrolled user (aribahri15@gmail.com) in {$courses->count()} course(s).");
        $this->command->info("Login credentials:");
        $this->command->info("Email: aribahri15@gmail.com");
        $this->command->info("Password: password");
    }
}
