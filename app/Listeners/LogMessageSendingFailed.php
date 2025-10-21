<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSendingFailed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogMessageSendingFailed
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
    public function handle(MessageSendingFailed $event): void
    {
        $message = $event->message;

        // Extract recipients
        $to = [];
        if ($message->getTo()) {
            foreach ($message->getTo() as $address) {
                $to[] = $address->getAddress();
            }
        }

        Log::error('Email sending FAILED', [
            'to' => $to,
            'subject' => $message->getSubject(),
            'error' => $event->exception ? $event->exception->getMessage() : 'Unknown error',
            'trace' => $event->exception ? $event->exception->getTraceAsString() : null,
        ]);
    }
}
