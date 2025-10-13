<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\Models\Course;

use App\Models\User;

use App\Models\Slider;

use App\Models\SiteSetting;

use App\Models\LegalPage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\DB;





class PageController extends Controller

{



   public function home()

   {

      $sliders = Slider::where('is_active', 1)->get();

      //$courses = Course::where('status', 'active')->where('is_active', 1)->latest()->paginate(6);

        $latestCourseIds = DB::table('courses')

    ->select(DB::raw('MIN(id) as id')) // assuming bigger ID = latest, or use MAX(created_at)

    ->where('status', 'active')

    ->where('is_active', 1)

    ->groupBy('category')

    ->pluck('id');  // get list of latest course ids



// Fetch full course records for those IDs, paginate after

$courses = Course::whereIn('id', $latestCourseIds)

    ->orderBy('created_at', 'desc')

    ->paginate(6);









      // Create an associative array of courses, keyed by slug

      $coursesBySlug = [];

      foreach ($courses as $course) {

         $coursesBySlug[$course->slug] = $course;

      }



      // Modify the redirect_url for each slider

      foreach ($sliders as $slider) {

         // Extract the slug from the slider's redirect_url.  Assume the URL contains the slug.

         $slug = basename($slider->redirect_url);



         // Check if a corresponding course exists

         if (isset($coursesBySlug[$slug])) {

            // Generate the route using the slug

            $slider->redirect_url = route('front.course.details', $slug);

         } else {

            $slider->redirect_url = '/'; // set to default

         }

      }



      //  return view('welcome', compact('sliders', 'courses'));

      return view('welcome', compact('sliders', 'courses'));

   }





public function courseCategory($category)
{
      $course = Course::where('Category', $category)->first();
      $courses = Course::where('Category', $category)->paginate(6);
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

     $courses = [];



      if(Auth::check()){

         $user_id = Auth::id();

         $courses = User::find($user_id)->purchasedCourses()->latest()->paginate(9);

         

      }else{

         $courses = Course::where('status', 'active')->where('is_active', 1)->latest()->paginate(9);



      }

      // dd($courses);



      return view('front.course', compact('courses'));

   }





   public function coursedetails($slug)

   {

      $course = Course::where('slug', $slug)->first();

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

         // Add more mappings if needed

      ];



      $viewName = $viewMap[$course->id];



      if (View::exists($viewName)) {

         return view($viewName, compact('course'));

      }

   }

   // public function coursedetails(Course $course)

   // {



   //     $slug = $course->slug;

   //    return view('front.'.$slug, compact('course'));

   // }



   public function about_us()

   {



      return view('front.about');

   }

   

   public function how_it_works(){

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

      //  dd($terms);

      return view('front.terms_conditon', compact('terms'));

   }





   public function privacy_policy()

   {

      $terms = LegalPage::first();

      return view('front.privacy_policy', compact('terms'));

   }



   public function commercialLearnerPermitEnglish()

   {

      // Fetch data specific to the English CLP page if needed



      $slug = 'commercial-leaner-s-permit-clp-english'; // Or however you determine the relevant slug

      $course = Course::where('slug', $slug)->firstOrFail();



      return view('front.commercial-leaner-s-permit-clp-english', compact('course'));

   }



   public function commercialLearnerPermitArabic()

   {

      $slug = 'commercial-leaner-s-permit-clp-arabic'; // Or however you determine the relevant slug

      $course = Course::where('slug', $slug)->firstOrFail();

      return view('front.commercial-leaner-s-permit-clp-arabic', compact('course'));

   }



   public function commercialLearnerPermitSomali()

   {

      $slug = 'commercial-leaner-s-permit-clp-somali'; // Or however you determine the relevant slug

      $course = Course::where('slug', $slug)->firstOrFail();



      return view('front.commercial-leaner-s-permit-clp-somali', compact('course'));

   }



   public function commercialLearnerPermitFrench()

   {

      $slug = 'commercial-leaner-s-permit-clp-french'; // Or however you determine the relevant slug

      $course = Course::where('slug', $slug)->firstOrFail();



      return view('front.commercial-leaner-s-permit-clp-french', compact('course'));

   }



   public function commercialLearnerPermitAmharic()

   {

      $slug = 'commercial-leaner-s-permit-clp-amharic'; // Or however you determine the relevant slug

      $course = Course::where('slug', $slug)->firstOrFail();

      return view('front.commercial-leaner-s-permit-clp-amharic', compact('course'));

   }



   public function commercialLearnerPermitNepali()

   {

      $slug = 'commercial-leaner-s-permit-clp-nepali'; // Or however you determine the relevant slug

      $course = Course::where('slug', $slug)->firstOrFail();



      return view('front.commercial-leaner-s-permit-clp-nepali', compact('course'));

   }

}

