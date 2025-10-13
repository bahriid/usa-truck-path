<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SiteSetting;


class ContactUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
         $siteSettings = SiteSetting::first(); // Fetch site settings (modify query as needed)

        return $this->from($siteSettings->contact_email??'admin@example.com',$siteSettings->site_title?? 'PassYourPermit') // Change to your company email
                    ->subject('Thank You for Contacting Us')
                    ->view('emails.user_contact')
                    ->with('data', $this->data);
    }
}
