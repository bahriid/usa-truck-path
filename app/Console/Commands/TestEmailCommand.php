<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:test {email : The email address to send test email to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration by sending a test email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Testing email configuration...");
        $this->info("Sending test email to: {$email}");

        try {
            Mail::raw('This is a test email from PassYourPermit. If you received this, your email configuration is working correctly!', function ($message) use ($email) {
                $message->to($email)
                    ->subject('Test Email - PassYourPermit');
            });

            $this->info("✓ Email sent successfully!");
            $this->info("Check the logs at storage/logs/laravel.log for detailed information.");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("✗ Failed to send email!");
            $this->error("Error: " . $e->getMessage());
            $this->info("Check the logs at storage/logs/laravel.log for detailed error information.");

            Log::error('Test email failed', [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return Command::FAILURE;
        }
    }
}
