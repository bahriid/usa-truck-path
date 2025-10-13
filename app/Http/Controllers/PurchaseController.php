<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class PurchaseController extends Controller
{
    public function purchase(Request $request, $courseId)
    {
        // 1. Ensure user is logged in
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to purchase the course.');
        }

        // 2. Check if course exists
        $course = Course::findOrFail($courseId);

        // 3. Check if user already purchased the course
        if ($user->hasPurchasedCourse($course->id)) {
            return redirect()->back()->with('error', 'You have already purchased this course.');
        }

        // 4. Attach course to user (You could integrate a payment system here)
        $user->purchasedCourses()->attach($course->id);

        return redirect()->back()->with('success', 'You have successfully enrolled in this course!');
    }
}
