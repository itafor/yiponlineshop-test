<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\PaystackPayment;
use App\Services\SmartyRenderer;
use Throwable;

class OrderController extends Controller
{
    public function index(SmartyRenderer $smarty)
    {
        return $smarty->render('orders/index.tpl', [
            'orders' => Order::where('user_id', auth()->id())->latest()->get(),
        ]);
    }

    public function show(Order $order, SmartyRenderer $smarty)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        return $smarty->render('orders/show.tpl', [
            'order' => $order->load('items'),
        ]);
    }

    public function pay(Order $order, PaystackPayment $paystack)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        abort_if($order->payment_status === 'paid', 422, 'This order is already paid.');

        try {
            $payment = $paystack->initialize($order);
            $order->update([
                'payment_reference' => $payment['reference'],
                'payment_authorization_url' => $payment['authorization_url'],
            ]);
        } catch (Throwable $exception) {
            report($exception);

            if (str_contains($exception->getMessage(), 'Your IP address is not allowed')) {
                return back()->with('error', 'Paystack rejected this server IP address. Add your current public IP to the Paystack allowed IP list, or remove the IP restriction in your Paystack dashboard.');
            }

            return back()->with('error', 'Paystack payment could not start. Please try again.');
        }

        return redirect()->away($payment['authorization_url']);
    }
}
