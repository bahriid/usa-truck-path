<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogSentMessage
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
    public function handle(MessageSending $event): void
    {
        $message = $event->message;

        // Extract recipients
        $to = [];
        if ($message->getTo()) {
            foreach ($message->getTo() as $address) {
                $to[] = $address->getAddress();
            }
        }

        Log::info('Attempting to send email', [
            'to' => $to,
            'subject' => $message->getSubject(),
            'from' => $message->getFrom() ? array_map(fn($addr) => $addr->getAddress(), $message->getFrom()) : null,
        ]);
    }
}
