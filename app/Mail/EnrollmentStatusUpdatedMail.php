<?php

namespace App\Mail;

use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnrollmentStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $enrollment;
    public $status;
    public $course; // Fetched from the course_id

    /**
     * Create a new message instance.
     *
     * @param  mixed  $enrollment  The enrollment record from the pivot table.
     * @param  string $status      The updated status.
     */
    public function __construct($enrollment, $status)
    {
         $this->enrollment = $enrollment;
         $this->status = $status;
         // Fetch the course from the course_id in the pivot record.
         $this->course = Course::find($enrollment->course_id);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Enrollment Status Has Been Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.enrollment_status_updated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
