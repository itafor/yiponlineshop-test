{extends file="layout.tpl"}
{block name=content}
<section class="admin-metrics">
    <div><span>Payment Records</span><strong>{$orders|count}</strong></div>
    <div><span>Paid Revenue</span><strong>&#8358;{$paidRevenue|number_format:2}</strong></div>
</section>

<section class="section-head">
    <div>
        <h1>Payment History</h1>
        <p>Paystack references and payment statuses across all orders.</p>
    </div>
</section>

<div class="table-wrap">
    <table>
        <thead><tr><th>Order</th><th>Customer</th><th>Reference</th><th>Amount</th><th>Status</th><th>Paid At</th><th>Action</th></tr></thead>
        <tbody>
            {foreach $orders as $order}
                <tr>
                    <td><a href="/admin/orders/{$order->id}">#{$order->id}</a></td>
                    <td>{$order->customer_name}<br><span>{$order->customer_email}</span></td>
                    <td>{$order->payment_reference}</td>
                    <td>&#8358;{$order->total|number_format:2}</td>
                    <td>{$order->payment_status|capitalize}</td>
                    <td>{if $order->paid_at}{$order->paid_at}{else}-{/if}</td>
                    <td><a class="button small" href="/admin/orders/{$order->id}">View Order</a></td>
                </tr>
            {foreachelse}
                <tr><td colspan="7">No payment records yet.</td></tr>
            {/foreach}
        </tbody>
    </table>
</div>
{/block}
