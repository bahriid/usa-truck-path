<?php

namespace App\Jobs;

use App\Models\CourseContent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessCourseContentUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;
    protected $courseId;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($file, $courseId, $data)
    {
        $this->file = $file;
        $this->courseId = $courseId;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        if ($this->file) {
            // Store file in storage
            $path = $this->file->store('course_contents', 'public');

            // Save file path in database
            $this->data['file_path'] = $path;
        }

        // Create course content record
        CourseContent::create([
            'course_id' => $this->courseId,
            'title'     => $this->data['title'],
            'type'      => $this->data['type'],
            'external_link' => $this->data['external_link'] ?? null,
            'content_text'  => $this->data['content_text'] ?? null,
            'order'         => $this->data['order'] ?? null,
            'meta'          => $this->data['meta'] ?? null,
            'file_path'     => $this->data['file_path'] ?? null,
        ]);
    }
}
