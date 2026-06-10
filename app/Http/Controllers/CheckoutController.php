<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\PaystackPayment;
use App\Services\SmartyRenderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class CheckoutController extends Controller
{
    public function show(SmartyRenderer $smarty)
    {
        $items = collect(session('cart.items', []))->map(function (array $item) {
            $item['line_total'] = $item['price'] * $item['quantity'];
            return $item;
        })->values();

        if ($items->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        return $smarty->render('checkout/show.tpl', [
            'items' => $items,
            'cartTotal' => $items->sum('line_total'),
        ]);
    }

    public function store(Request $request, PaystackPayment $paystack)
    {
        $items = collect(session('cart.items', []));

        if ($items->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $data = $request->validate([
            'shipping_address' => ['required', 'string', 'max:800'],
        ]);

        try {
            $order = DB::transaction(function () use ($items, $data) {
                $products = Product::whereIn('id', $items->pluck('product_id'))->lockForUpdate()->get()->keyBy('id');

                $total = $items->sum(fn (array $item) => $item['price'] * $item['quantity']);

                foreach ($items as $item) {
                    $product = $products->get($item['product_id']);

                    if (! $product || ! $product->is_active || $product->stock < 1) {
                        throw new RuntimeException("{$item['name']} is out of stock. Please remove it from your cart.");
                    }

                    if ($product->stock < $item['quantity']) {
                        throw new RuntimeException("Only {$product->stock} unit(s) of {$product->name} are available. Please update your cart.");
                    }
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'customer_name' => auth()->user()->name,
                    'customer_email' => auth()->user()->email,
                    'shipping_address' => $data['shipping_address'],
                    'status' => 'pending',
                    'payment_status' => 'unpaid',
                    'payment_reference' => 'YIP-'.Str::upper(Str::random(16)),
                    'total' => $total,
                ]);

                foreach ($items as $item) {
                    $product = $products->get($item['product_id']);
                    $lineTotal = $item['price'] * $item['quantity'];

                    $order->items()->create([
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'unit_price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'line_total' => $lineTotal,
                    ]);

                    $product->decrement('stock', $item['quantity']);
                }

                return $order;
            });
        } catch (RuntimeException $exception) {
            return redirect('/cart')->with('error', $exception->getMessage());
        }

        try {
            $payment = $paystack->initialize($order);
            $order->update([
                'payment_reference' => $payment['reference'],
                'payment_authorization_url' => $payment['authorization_url'],
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return redirect('/orders/'.$order->id)
                ->with('error', 'The order was created, but Paystack payment could not start. '.$this->paystackErrorMessage($exception));
        }

        session()->forget('cart.items');

        return redirect()->away($payment['authorization_url']);
    }

    public function paystackCallback(Request $request, PaystackPayment $paystack)
    {
        $reference = $request->query('reference');

        if (! $reference) {
            return redirect('/')->with('error', 'Payment reference was not returned by Paystack.');
        }

        $order = Order::where('payment_reference', $reference)->firstOrFail();

        try {
            $payment = $paystack->verify($reference);
        } catch (Throwable $exception) {
            report($exception);

            $order->update(['payment_status' => 'failed']);

            return redirect('/orders/'.$order->id)
                ->with('error', 'We could not verify your Paystack payment. Please contact support if you were debited.');
        }

        $expectedAmount = (int) round($order->total * 100);

        if ($payment['status'] === 'success' && (int) $payment['amount'] === $expectedAmount) {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'paid_at' => now(),
            ]);

            return redirect('/orders/'.$order->id)
                ->with('success', 'Payment successful. Your order is now processing.');
        }

        $order->update(['payment_status' => 'failed']);

        return redirect('/orders/'.$order->id)
            ->with('error', 'Payment was not successful. You can retry from this order page.');
    }

    private function paystackErrorMessage(Throwable $exception): string
    {
        if (str_contains($exception->getMessage(), 'Your IP address is not allowed')) {
            return 'Paystack rejected this server IP address. Add your current public IP to the Paystack allowed IP list, or remove the IP restriction in your Paystack dashboard.';
        }

        return 'Please try again from the order page.';
    }
}
