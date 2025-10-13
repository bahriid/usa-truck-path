<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.create', compact('instructors'));
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'menu_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string',
            'category' => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
            'is_active' => 'boolean',
            'max_students' => 'nullable|integer|min:1',
            'instructor_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|max:2048',
            'slug' => 'required|unique:courses,slug',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        
        ]);
   

        $course = new Course($request->all());

        if ($request->hasFile('image')) {
            $course->image = $request->file('image')->store('courses', 'public');
        }

        $course->save();

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.courses.create', compact('course', 'instructors'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
             'menu_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string',
            'category' => 'nullable|string',
            'status' => 'required|in:active,inactive,draft',
            'is_active' => 'boolean',
            'max_students' => 'nullable|integer|min:1',
            'instructor_id' => 'nullable|exists:users,id',
            'image' => 'nullable|image|max:2048',
            'slug' => 'required|unique:courses,slug,' . $course->id,
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);


        $course->update($request->all());

         // Delete old images if new ones are uploaded
         if ($request->hasFile('image') && $course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        if ($request->hasFile('image')) {
            
            $course->image = $request->file('image')->store('courses', 'public');
            $course->save();
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        // Delete course image if it exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
        
            // Delete all related topics' resources before deleting the course
            foreach ($course->chapters as $chapter) {
                foreach ($chapter->topics as $topic) {
                    // Delete topic resources if they exist
                    if ($topic->local_video) {
                        Storage::disk('public')->delete($topic->local_video);
                    }
                    if ($topic->pdf) {
                        Storage::disk('public')->delete($topic->pdf);
                    }
                    if ($topic->voice) {
                        Storage::disk('public')->delete($topic->voice);
                    }
                }
            }

        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
