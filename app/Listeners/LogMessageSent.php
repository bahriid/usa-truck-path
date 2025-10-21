<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogMessageSent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        // Extract recipients
        $to = [];
        if ($message->getTo()) {
            foreach ($message->getTo() as $address) {
                $to[] = $address->getAddress();
            }
        }

        Log::info('Email sent successfully', [
            'to' => $to,
            'subject' => $message->getSubject(),
        ]);
    }
}
