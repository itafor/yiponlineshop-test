<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PaystackPayment
{
    /**
     * @return array{authorization_url: string, reference: string}
     */
    public function initialize(Order $order): array
    {
        $response = Http::timeout(30)
            ->withToken($this->secretKey())
            ->post($this->baseUrl().'/transaction/initialize', [
                'email' => $order->customer_email,
                'amount' => (int) round($order->total * 100),
                'reference' => $order->payment_reference,
                'callback_url' => url('/checkout/paystack/callback'),
                'metadata' => [
                    'order_id' => $order->id,
                    'customer_name' => $order->customer_name,
                ],
            ]);

        if (! $response->successful() || ! $response->json('status')) {
            throw new RuntimeException('Paystack initialization failed: '.$this->errorMessage($response->body()));
        }

        return [
            'authorization_url' => $response->json('data.authorization_url'),
            'reference' => $response->json('data.reference'),
        ];
    }

    /**
     * @return array{status: string|null, amount: int|null, reference: string|null}
     */
    public function verify(string $reference): array
    {
        $response = Http::timeout(30)
            ->withToken($this->secretKey())
            ->get($this->baseUrl().'/transaction/verify/'.$reference);

        if (! $response->successful() || ! $response->json('status')) {
            throw new RuntimeException('Paystack verification failed: '.$this->errorMessage($response->body()));
        }

        return [
            'status' => $response->json('data.status'),
            'amount' => $response->json('data.amount'),
            'reference' => $response->json('data.reference'),
        ];
    }

    private function baseUrl(): string
    {
        return rtrim(config('services.paystack.url', 'https://api.paystack.co'), '/');
    }

    private function secretKey(): string
    {
        $key = config('services.paystack.secret_key');

        if (! $key) {
            throw new RuntimeException('PAYSTACK_SECRET_KEY is not configured.');
        }

        return $key;
    }

    private function errorMessage(string $body): string
    {
        $payload = json_decode($body, true);

        return $payload['message'] ?? $body;
    }
}
