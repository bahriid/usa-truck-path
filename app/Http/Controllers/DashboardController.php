<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show user dashboard with their enrolled courses and tier status.
     */
    public function index()
    {
        $user = auth()->user();

        // Get user's enrolled courses
        $enrolledCourses = $user->getEnrolledCourses();

        if ($enrolledCourses->isEmpty()) {
            // User hasn't enrolled in any course yet
            return redirect()->route('front.home')
                ->with('info', 'Please select a course to get started.');
        }

        // Get tier information for each course
        $coursesWithTiers = $enrolledCourses->map(function ($course) use ($user) {
            $tier = $user->getSubscriptionTier($course->id);

            return [
                'course' => $course,
                'current_tier' => $tier,
                'premium_price' => $course->getPremiumPrice(),
            ];
        });

        return view('front.dashboard', compact('coursesWithTiers', 'user'));
    }
}
