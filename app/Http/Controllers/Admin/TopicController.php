<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Chapter;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    // List topics for a given chapter (nested under a course)
    public function index($courseId, $chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $topics = $chapter->topics()->latest()->paginate(10);
        return view('admin.topics.index', compact('chapter', 'topics', 'courseId'));
    }

    // Show form to create a new topic
    public function create($courseId, $chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        return view('admin.topics.create', compact('chapter', 'courseId'));
    }

    // Store a new topic
    public function store(Request $request, $courseId, $chapterId)
    {
        // dd($request->all());
        $request->validate([
            'type'        => 'required|in:video,reading,pdf,voice',
            'title'       => 'required|string|max:255',
            'duration'    => 'nullable', // Only required if type is video, but can be null otherwise
            'source_from' => 'nullable|required_if:type,video|in:youtube,vimeo,local,other', // Only required if type is video
            'video_url'   => 'nullable|required_if:source_from,youtube,vimeo,other|url', // Only required if source_from is youtube, vimeo, or other
            'local_video' => 'nullable|required_if:source_from,local', // Only required if source_from is local
            'description' => 'nullable|required_if:type,reading', // Only required if type is reading
            'pdf' => 'nullable|required_if:type,pdf', // Only required if type is reading
            'voice' => 'nullable|required_if:type,voice', // Only required if type is reading
        ]);
        

        $data = $request->all();

        // Handle local video upload if provided
if ($request->input('local_video')) {
        $data['local_video'] = 'topics/videos/' . $request->input('local_video');
    }
    if ($request->input('pdf')) {
        $data['pdf'] = 'topics/pdfs/' . $request->input('pdf');
    }
    if ($request->input('voice')) {
        $data['voice'] = 'topics/audios/' . $request->input('voice');
    }
        $data['chapter_id'] = $chapterId;
        Topic::create($data);

        return redirect()->route('topics.index', [$courseId, $chapterId])
                         ->with('success', 'Topic added successfully.');
    }

    // Show form to edit a topic
    public function edit($courseId, $chapterId, $topicId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $topic   = Topic::findOrFail($topicId);
        return view('admin.topics.edit', compact('chapter', 'topic', 'courseId'));
    }

    // Update the topic
    // public function update(Request $request, $courseId, $chapterId, $topicId)
    // {
    //     $request->validate([
    //         'type'        => 'required|in:video,reading',
    //         'title'       => 'required|string|max:255',
    //         'duration'    => 'nullable|required_if:type,video',
    //         'source_from' => 'nullable|required_if:type,video|in:youtube,vimeo,local,other',
    //         'video_url'   => 'nullable|required_if:source_from,youtube,vimeo,other|url',
    //         'local_video' => 'nullable|nullable|file',
    //         'description' => 'nullable|required_if:type,reading',
    //         'pdf'         => 'nullable|required_if:type,pdf|file',
    //         'voice'       => 'nullable|required_if:type,voice|file',
    //     ]);

    //     $topic = Topic::findOrFail($topicId);
    //     $data  = $request->all();

    //     if($request->hasFile('local_video')){
    //         $data['local_video'] = $request->file('local_video')->store('topics/videos', 'public');
    //     }

    //     $topic->update($data);

    //     return redirect()->route('topics.index', [$courseId, $chapterId])
    //                      ->with('success', 'Topic updated successfully.');
    // }
    public function update(Request $request, $courseId, $chapterId, $topicId)
    {
        $topic = Topic::findOrFail($topicId);
    
        $request->validate([
            'type'        => 'required|in:video,reading,pdf,voice',
            'title'       => 'required|string|max:255',
            'duration'    => 'nullable|required_if:type,video',
            'source_from' => 'nullable|required_if:type,video|in:youtube,vimeo,local,other',
            'video_url'   => 'nullable|required_if:source_from,youtube,vimeo,other|url',
            'local_video' => 'nullable|required_if:source_from,local|file',
            'description' => 'nullable|required_if:type,reading',
            'pdf'         => 'nullable|required_if:type,pdf|file',
            'voice'       => 'nullable|required_if:type,voice|file',
        ]);
    
        $data = $request->all();
    
        // Handle local video update (Delete old video if new one is uploaded)
        if ($request->hasFile('local_video')) {
            if ($topic->local_video) {
                Storage::disk('public')->delete($topic->local_video);
            }
            $data['local_video'] = $request->file('local_video')->store('topics/videos', 'public');
        }
    
        // Handle PDF update (Delete old PDF if new one is uploaded)
        if ($request->hasFile('pdf')) {
            if ($topic->pdf) {
                Storage::disk('public')->delete($topic->pdf);
            }
            $data['pdf'] = $request->file('pdf')->store('topics/pdfs', 'public');
        }
    
        // Handle Voice (Audio) update (Delete old voice file if new one is uploaded)
        if ($request->hasFile('voice')) {
            if ($topic->voice) {
                Storage::disk('public')->delete($topic->voice);
            }
            $data['voice'] = $request->file('voice')->store('topics/audios', 'public');
        }
    
        $topic->update($data);
    
        return redirect()->route('topics.index', [$courseId, $chapterId])
                         ->with('success', 'Topic updated successfully.');
    }
    
    // Delete the topic
    public function destroy($courseId, $chapterId, $topicId)
    {
        $topic = Topic::findOrFail($topicId);
        
    // Delete associated files if they exist
    if ($topic->local_video) {
        Storage::disk('public')->delete($topic->local_video);
    }

    if ($topic->pdf) {
        Storage::disk('public')->delete($topic->pdf);
    }

    if ($topic->voice) {
        Storage::disk('public')->delete($topic->voice);
    }
        $topic->delete();
        return redirect()->route('topics.index', [$courseId, $chapterId])
                         ->with('success', 'Topic deleted successfully.');
    }
}
