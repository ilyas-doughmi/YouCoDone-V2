<?php

namespace App\Services;

use App\Interfaces\PaymentInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class StripeService implements PaymentInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function pay(float $amount, array $data)
    {
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Reservation Restaurant',
                        ],
                        'unit_amount' => $amount * 100, 
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}&reservation_id=' . $data['reservation_id'],
                'cancel_url' => route('payment.cancel'),
                'metadata' => [
                    'reservation_id' => $data['reservation_id']
                ]
            ]);

            return $session->url;
        } catch (\Exception $e) {
            Log::error('Stripe Payment Error: ' . $e->getMessage());
            return null;
        }
    }

    public function execute($request)
    {
        try {
            $sessionId = $request->query('session_id');
            if (!$sessionId) {
                return false;
            }

            $session = Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                return $session->payment_intent;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Stripe Execute Error: ' . $e->getMessage());
            return false;
        }
    }

    public function refund(string $transactionId)
    {
        try {
            $refund = \Stripe\Refund::create([
                'payment_intent' => $transactionId,
            ]);

            return $refund->status === 'succeeded' || $refund->status === 'pending';
        } catch (\Exception $e) {
            Log::error('Stripe Refund Error: ' . $e->getMessage());
            return false;
        }
    }
}