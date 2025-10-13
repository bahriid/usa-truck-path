<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Slider;
use App\Models\SiteSetting;
use App\Models\LegalPage;
use Illuminate\Http\Request;

class PageController extends Controller
{

   public function home(){
      $sliders = Slider::where('is_active', 1)->get();
    //   $courses = Course::where('status','active')->where('is_active',1)->latest()->paginate(6);
    $courses = Course::where('is_active', 1)
    ->orderBy('order')
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

      return view('welcome',compact('sliders','courses'));
   }
     public function course(){
        // $courses = Course::where('status','active')->where('is_active',1)->latest()->paginate(9);
            $courses = Course::where('is_active', 1)
    ->orderBy('order')
    ->orderBy('created_at', 'desc')
    ->paginate(6);
        return view('front.course',compact('courses'));
     }
     public function coursedetails($slug){
        $course = Course::where('slug',$slug)->first();
        return view('front.'.$slug,compact('course'));
     }

       public function about_us(){
           
         return view('front.about');
       }
         public function contact_us(){
              $setting = SiteSetting::first();
            return view('front.contact',compact('setting'));
         }
         public function terms_condition(){
             $terms= LegalPage::first();
            //  dd($terms);
            return view('front.terms_conditon',compact('terms'));
         }
         public function privacy_policy(){
                 $terms= LegalPage::first();
            return view('front.privacy_policy',compact('terms'));
         }
}
