<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Course;

class ChapterController extends Controller
{
    // List all chapters for a given course
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);

        // $chapters = $course->chapters()->latest()->paginate(10);
        $chapters = Chapter::where('course_id', $course->id)->orderBy('order')->paginate(10);

        return view('admin.chapters.index', compact('course', 'chapters'));
    }

    // Show form to create a new chapter
    public function create($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('admin.chapters.create', compact('course'));
    }

    // Store a new chapter in the database
    public function store(Request $request, $courseId)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = Course::findOrFail($courseId);
        $course->chapters()->create($request->only('title', 'description'));

        return redirect()->route('chapters.index', $courseId)
                         ->with('success', 'Chapter added successfully.');
    }

    // Show form to edit an existing chapter
    public function edit($courseId, $chapterId)
    {
        $course  = Course::findOrFail($courseId);
        $chapter = Chapter::findOrFail($chapterId);
        return view('admin.chapters.edit', compact('course', 'chapter'));
    }

    // Update the chapter in the database
    public function update(Request $request, $courseId, $chapterId)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $chapter = Chapter::findOrFail($chapterId);
        $chapter->update($request->only('title', 'description'));

        return redirect()->route('chapters.index', $courseId)
                         ->with('success', 'Chapter updated successfully.');
    }

    // Delete the chapter
    public function destroy($courseId, $chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $chapter->delete();
        return redirect()->route('chapters.index', $courseId)
                         ->with('success', 'Chapter deleted successfully.');
    }


    public function reorder(Request $request)
{
    foreach ($request->order as $chapter) {
        Chapter::where('id', $chapter['id'])->update(['order' => $chapter['position']]);
    }

    return response()->json(['message' => 'Chapters reordered successfully!']);
}

}
