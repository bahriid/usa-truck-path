<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Lang;
use App\Models\SiteSetting;

class CustomVerifyEmail extends BaseVerifyEmail
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        // Retrieve your settings and logo URL
        $setting = SiteSetting::first();
        $logoUrl = asset(Storage::url($setting->main_logo));


        // Use a Markdown template so you can include HTML like the logo
        return (new MailMessage)
            ->subject(Lang::get('Verify Email Address'))
            ->markdown('emails.verify', [
                'url'     => $url,
                'logoUrl' => $logoUrl,
            ]);
    }
}
