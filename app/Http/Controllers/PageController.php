<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LegalPage;
use App\Models\SiteSetting;
use App\Models\Slider;
use App\Services\GeoIPService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home(GeoIPService $geoIP)
    {
        $sliders = Slider::where('is_active', 1)->get();
        $settings = SiteSetting::first();
        $geoFilteringEnabled = $settings->geo_filtering_enabled ?? false;
        $regionCode = $geoFilteringEnabled ? $geoIP->getRegionCode() : null;

        // Get one latest course per category, filtered by user's region (if enabled)
        $latestCourseIds = DB::table('courses')
            ->select(DB::raw('MIN(id) as id'))
            ->where('status', 'active')
            ->where('is_active', 1)
            ->when($regionCode, function ($query) use ($regionCode) {
                $query->where(function ($q) use ($regionCode) {
                    $q->where('country_code', $regionCode)
                      ->orWhere('country_code', 'DISABLED');
                });
            })
            ->groupBy('category')
            ->pluck('id');

        $courses = Course::whereIn('id', $latestCourseIds)
            ->orderBy('order')
            ->orderBy('id', 'asc')
            ->paginate(6);

        // Create an associative array of courses, keyed by slug
        $coursesBySlug = $courses->keyBy('slug');

        // Modify the redirect_url for each slider
        foreach ($sliders as $slider) {
            $slug = basename($slider->redirect_url);

            if ($coursesBySlug->has($slug)) {
                $slider->redirect_url = route('front.course.details', $slug);
            } else {
                $slider->redirect_url = '/';
            }
        }

        return view('new-design.home', compact('sliders', 'courses'));
    }

    public function courseCategory($category)
    {
        $course = Course::where('category', $category)->first();
        $courses = Course::where('category', $category)->paginate(6);

        if ($courses->total() > 1) {
            return view('new-design.course-category', compact('course', 'courses'));
        }

        if ($course) {
            return redirect()->route('front.course.details', ['slug' => $course->slug]);
        }

        abort(404);
    }

    public function course(GeoIPService $geoIP)
    {
        $settings = SiteSetting::first();
        $geoFilteringEnabled = $settings->geo_filtering_enabled ?? false;
        $regionCode = $geoFilteringEnabled ? $geoIP->getRegionCode() : null;

        // Get one latest course per category, filtered by user's region (if enabled)
        $latestCourseIds = DB::table('courses')
            ->select(DB::raw('MIN(id) as id'))
            ->where('status', 'active')
            ->where('is_active', 1)
            ->when($regionCode, function ($query) use ($regionCode) {
                $query->where(function ($q) use ($regionCode) {
                    $q->where('country_code', $regionCode)
                      ->orWhere('country_code', 'DISABLED');
                });
            })
            ->groupBy('category')
            ->pluck('id');

        $courses = Course::whereIn('id', $latestCourseIds)
            ->orderBy('order')
            ->orderBy('id', 'asc')
            ->paginate(6);

        // Get user's enrolled course IDs if logged in
        $enrolledCourseIds = [];
        if (auth()->check()) {
            $enrolledCourseIds = auth()->user()->purchasedCourses()
                ->wherePivot('status', 'approved')
                ->pluck('courses.id')
                ->toArray();
        }

        return view('new-design.course', compact('courses', 'enrolledCourseIds'));
    }

    public function coursedetails($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        // If this is a language-specific course (has parent_course_id), redirect to the free parent course
        // But only if user is NOT logged in OR doesn't have approved enrollment
        if ($course->parent_course_id) {
            $parentCourse = Course::find($course->parent_course_id);

            if ($parentCourse) {
                // If user is logged in and already enrolled in THIS specific language course, show it
                if (auth()->check() && auth()->user()->hasApprovedCourse($course->id)) {
                    return redirect()->route('course.curriculam', $course->id);
                }

                // Otherwise, redirect to the parent free course
                return redirect()->route('front.course.details', $parentCourse->slug);
            }
        }

        // If user is logged in and has approved enrollment, redirect to curriculum
        if (auth()->check()) {
            $user = auth()->user();

            // Auto-enroll for free language_selector courses
            if ($course->isLanguageSelectorCourse() && !$user->hasApprovedCourse($course->id)) {
                // Auto-enroll user for free with approved status
                $user->purchasedCourses()->attach($course->id, [
                    'full_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? '',
                    'country' => $user->country ?? '',
                    'status' => 'approved',  // Auto-approve free courses
                    'subscription_tier' => 'free',
                    'transaction_amount' => 0,
                    'transaction_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Check if user has approved enrollment
            if ($user->hasApprovedCourse($course->id)) {
                // For language_selector courses, show detail page (not curriculum)
                // so they can choose their language upgrade
                if (!$course->isLanguageSelectorCourse()) {
                    return redirect()->route('course.curriculam', $course->id);
                }
            }

            // Generate Telegram invite link if user is enrolled and hasn't got one yet
            $enrollmentService = app(\App\Services\EnrollmentService::class);
            $enrollmentService->generateTelegramInvite($user, $course);
        }

        // Get view template from database
        $template = DB::table('course_view_templates')
            ->where('course_id', $course->id)
            ->where('is_active', true)
            ->first();

        if ($template && View::exists($template->view_name)) {
            return view($template->view_name, compact('course'));
        }

        // Fallback to new design course details view
        return view('new-design.course_details', compact('course'));
    }

    public function about_us()
    {
        return view('new-design.about');
    }

    public function how_it_works()
    {
        return view('new-design.how_it_works');
    }

    public function mentorship()
    {
        return view('new-design.mentorship');
    }

    public function contact_us()
    {
        $setting = SiteSetting::first();
        return view('new-design.contact', compact('setting'));
    }

    public function terms_condition()
    {
        $terms = LegalPage::first();
        return view('new-design.terms_condition', compact('terms'));
    }

    public function privacy_policy()
    {
        $terms = LegalPage::first();
        return view('new-design.privacy_policy', compact('terms'));
    }
}