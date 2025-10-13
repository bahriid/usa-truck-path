<?php

namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;
use App\Models\SiteSetting;



class ContactAdminMail extends Mailable

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
        $siteSettings = SiteSetting::first();
        // return $this->from($this->data['email'], $this->data['name'])

        return $this->from($siteSettings->contact_email??'admin@example.com', $this->data['name']) // Change to your company email
        ->replyTo($this->data['email'], $this->data['name'])
        ->subject('New Contact Form Submission')
        ->view('emails.admin_contact')
        ->with('data', $this->data);

    }

}

