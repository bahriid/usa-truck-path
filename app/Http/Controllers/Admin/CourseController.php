<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected FileUploadService $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
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
            $course->image = $this->fileUploadService->upload($request->file('image'), 'courses');
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
            'slug' => 'required|unique:courses,slug,'.$course->id,
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $course->update($request->all());

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $course->image = $this->fileUploadService->upload($request->file('image'), 'courses', $course->image);
            $course->save();
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        // Delete course image if it exists
        if ($course->image) {
            $this->fileUploadService->delete($course->image);
        }

        // Delete all related topics' resources before deleting the course
        foreach ($course->chapters as $chapter) {
            foreach ($chapter->topics as $topic) {
                // Delete topic resources if they exist
                $this->fileUploadService->deleteMultiple($topic, ['local_video', 'pdf', 'voice']);
            }
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
