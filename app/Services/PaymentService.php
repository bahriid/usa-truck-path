<?php

namespace App\Services;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * Create a Stripe checkout session for course enrollment
     *
     * @param Course $course
     * @param float $price
     * @param string $successUrl
     * @param string $cancelUrl
     * @return Session
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCheckoutSession(Course $course, float $price, string $successUrl, string $cancelUrl): Session
    {
        try {
            return $this->stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $course->title,
                            ],
                            'unit_amount' => $price * 100, // Convert to cents
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Checkout Session Creation Error: '.$e->getMessage());
            throw $e;
        }
    }

    /**
     * Retrieve a Stripe checkout session by ID
     *
     * @param string $sessionId
     * @return Session
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function retrieveSession(string $sessionId): Session
    {
        try {
            return $this->stripe->checkout->sessions->retrieve($sessionId);
        } catch (\Exception $e) {
            Log::error('Stripe Session Retrieval Error: '.$e->getMessage());
            throw $e;
        }
    }

    /**
     * Verify that a session payment was completed successfully
     *
     * @param string $sessionId
     * @return bool
     */
    public function verifyPayment(string $sessionId): bool
    {
        try {
            $session = $this->retrieveSession($sessionId);

            return $session->payment_status === 'paid';
        } catch (\Exception $e) {
            Log::error('Payment Verification Error: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Create a direct Stripe charge (legacy method for card tokens)
     *
     * @param float $amount Amount in dollars
     * @param string $token Stripe token from frontend
     * @param string $description Payment description
     * @return Charge
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function createCharge(float $amount, string $token, string $description): Charge
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            return Charge::create([
                'amount' => $amount * 100, // Convert to cents
                'currency' => 'usd',
                'source' => $token,
                'description' => $description,
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Charge Creation Error: '.$e->getMessage());
            throw $e;
        }
    }

    /**
     * Process a charge and verify it succeeded
     *
     * @param float $amount
     * @param string $token
     * @param string $description
     * @return string Transaction ID
     * @throws \Exception
     */
    public function processCharge(float $amount, string $token, string $description): string
    {
        $charge = $this->createCharge($amount, $token, $description);

        if ($charge->status !== 'succeeded') {
            throw new \Exception('Payment processing failed. Charge status: '.$charge->status);
        }

        return $charge->id;
    }
}
