<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseContentController extends Controller
{
    // Display a list of contents for a given course
    public function index(Course $course)
    {
        $contents = $course->contents()->orderBy('order')->get();
        return view('admin.courses.content.index', compact('course', 'contents'));
    }

    // Show form to create new content for a course
    public function create(Course $course)
    {
        return view('admin.courses.content.create', compact('course'));
    }

    // Store new course content
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title'         => 'nullable|string|max:255',
            'type'          => 'required|string', // Consider using in:image,pdf,text,video,external_link
            'external_link' => 'nullable|url',
            'content_text'  => 'nullable|string',
            'order'         => 'nullable|integer',
            'meta'          => 'nullable|json',
            // Validate file if a file is uploaded
            'file'          => 'nullable|file|max:10240', // up to 10MB
        ]);

        $data = $request->only(['title', 'type', 'external_link', 'content_text', 'order', 'meta']);

        // Handle file upload if provided
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('course_contents', 'public');
        }

        // Create the content under the specified course
        $course->contents()->create($data);

        return redirect()->route('courses.contents.index', $course->id)
                         ->with('success', 'Course content added successfully.');
    }

    // Show form to edit existing content
    public function edit(Course $course, CourseContent $content)
    {
        return view('admin.courses.content.edit', compact('course', 'content'));
    }

    // Update the course content
    public function update(Request $request, Course $course, CourseContent $content)
    {
        $request->validate([
            'title'         => 'nullable|string|max:255',
            'type'          => 'required|string',
            'external_link' => 'nullable|url',
            'content_text'  => 'nullable|string',
            'order'         => 'nullable|integer',
            'meta'          => 'nullable|json',
            'file'          => 'nullable|file|max:10240',
        ]);

        $data = $request->only(['title', 'type', 'external_link', 'content_text', 'order', 'meta']);

        // If a new file is uploaded, remove the old one and store the new file
        if ($request->hasFile('file')) {
            if ($content->file_path) {
                Storage::disk('public')->delete($content->file_path);
            }
            $data['file_path'] = $request->file('file')->store('course_contents', 'public');
        }

        $content->update($data);

        return redirect()->route('courses.contents.index', $course->id)
                         ->with('success', 'Course content updated successfully.');
    }

    // Delete course content
    public function destroy(Course $course, CourseContent $content)
    {
        if ($content->file_path) {
            Storage::disk('public')->delete($content->file_path);
        }
        $content->delete();

        return redirect()->route('courses.contents.index', $course->id)
                         ->with('success', 'Course content deleted successfully.');
    }
}
