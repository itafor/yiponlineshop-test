<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\SmartyRenderer;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(SmartyRenderer $smarty)
    {
        return $smarty->render('admin/orders.tpl', [
            'orders' => Order::with('items')->latest()->get(),
            'revenue' => Order::sum('total'),
        ]);
    }

    public function show(Order $order, SmartyRenderer $smarty)
    {
        return $smarty->render('admin/order-show.tpl', [
            'order' => $order->load('items'),
        ]);
    }

    public function payments(SmartyRenderer $smarty)
    {
        return $smarty->render('admin/payments.tpl', [
            'orders' => Order::whereNotNull('payment_reference')->latest()->get(),
            'paidRevenue' => Order::where('payment_status', 'paid')->sum('total'),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,completed,cancelled'],
        ]);

        $order->update($data);

        return back()->with('success', 'Order status updated.');
    }
}
