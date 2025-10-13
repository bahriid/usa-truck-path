<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LegalPage;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('is_active', 1)->get();

        // Get one latest course per category
        $latestCourseIds = DB::table('courses')
            ->select(DB::raw('MIN(id) as id'))
            ->where('status', 'active')
            ->where('is_active', 1)
            ->groupBy('category')
            ->pluck('id');

        $courses = Course::whereIn('id', $latestCourseIds)
            ->orderBy('created_at', 'desc')
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

        return view('welcome', compact('sliders', 'courses'));
    }

    public function courseCategory($category)
    {
        $course = Course::where('category', $category)->first();
        $courses = Course::where('category', $category)->paginate(6);

        if ($courses->total() > 1) {
            return view('front.course-category', compact('course', 'courses'));
        }

        if ($course) {
            return redirect()->route('front.course.details', ['slug' => $course->slug]);
        }

        abort(404);
    }

    public function course()
    {
        if (auth()->check()) {
            $courses = auth()->user()->purchasedCourses()->latest()->paginate(9);
        } else {
            $courses = Course::where('status', 'active')
                ->where('is_active', 1)
                ->latest()
                ->paginate(9);
        }

        return view('front.course', compact('courses'));
    }

    public function coursedetails($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        // Define a mapping between course IDs and view file names
        $viewMap = [
            9 => 'front.commercial-leaner-s-permit-clp-english',
            10 => 'front.commercial-leaner-s-permit-clp-arabic',
            11 => 'front.commercial-leaner-s-permit-clp-amharic',
            12 => 'front.commercial-leaner-s-permit-clp-french',
            13 => 'front.commercial-leaner-s-permit-clp-nepali',
            14 => 'front.commercial-leaner-s-permit-clp-somali',
            15 => 'front.cdl-canada',
            16 => 'front.cdl-europe',
            17 => 'front.cdl-global',
            18 => 'front.cdl-test-course',
            19 => 'front.cdl-test-course',
        ];

        $viewName = $viewMap[$course->id] ?? null;

        if ($viewName && View::exists($viewName)) {
            return view($viewName, compact('course'));
        }

        abort(404);
    }

    public function about_us()
    {
        return view('front.about');
    }

    public function how_it_works()
    {
        return view('front.how_it_works');
    }

    public function contact_us()
    {
        $setting = SiteSetting::first();
        return view('front.contact', compact('setting'));
    }

    public function terms_condition()
    {
        $terms = LegalPage::first();
        return view('front.terms_conditon', compact('terms'));
    }

    public function privacy_policy()
    {
        $terms = LegalPage::first();
        return view('front.privacy_policy', compact('terms'));
    }
}