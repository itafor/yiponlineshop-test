{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>My Orders</h1>
        <p>Track your orders, payment status, and fulfillment progress.</p>
    </div>
    <a class="button small" href="/">Continue shopping</a>
</section>

<div class="table-wrap">
    <table>
        <thead><tr><th>Order</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            {foreach $orders as $order}
                <tr>
                    <td>#{$order->id}</td>
                    <td>&#8358;{$order->total|number_format:2}</td>
                    <td>{$order->payment_status|capitalize}</td>
                    <td>{$order->status|capitalize}</td>
                    <td>{$order->created_at}</td>
                    <td><a class="button small" href="/orders/{$order->id}">View</a></td>
                </tr>
            {foreachelse}
                <tr><td colspan="6">You have not placed any orders yet.</td></tr>
            {/foreach}
        </tbody>
    </table>
</div>
{/block}
