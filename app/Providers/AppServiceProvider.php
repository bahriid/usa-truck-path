<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Events\MessageSendingFailed;
use App\Listeners\LogSentMessage;
use App\Listeners\LogMessageSent;
use App\Listeners\LogMessageSendingFailed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register mail event listeners for logging
        Event::listen(MessageSending::class, LogSentMessage::class);
        Event::listen(MessageSent::class, LogMessageSent::class);
        Event::listen(MessageSendingFailed::class, LogMessageSendingFailed::class);
    }
}
