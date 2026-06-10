{extends file="layout.tpl"}
{block name=content}
<section class="admin-metrics">
    <div><span>Total Orders</span><strong>{$orders|count}</strong></div>
    <div><span>Revenue</span><strong>&#8358;{$revenue|number_format:2}</strong></div>
</section>
<section class="section-head">
    <div>
        <h1>Admin Orders</h1>
        <p>Manage fulfillment status for customer orders.</p>
    </div>
</section>
<div class="table-wrap">
    <table>
        <thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            {foreach $orders as $order}
                <tr>
                    <td><a href="/admin/orders/{$order->id}">#{$order->id}</a></td>
                    <td>{$order->customer_name}<br><span>{$order->customer_email}</span></td>
                    <td>&#8358;{$order->total|number_format:2}</td>
                    <td>{$order->payment_status|capitalize}</td>
                    <td>{$order->status|capitalize}</td>
                    <td>
                        <div class="action-row">
                            <a class="button small" href="/admin/orders/{$order->id}">View</a>
                            <form method="post" action="/admin/orders/{$order->id}" class="status-form">
                                <input type="hidden" name="_token" value="{$csrf}">
                                <input type="hidden" name="_method" value="PATCH">
                                <select name="status">
                                    {foreach ['pending','processing','shipped','completed','cancelled'] as $status}
                                        <option value="{$status}" {if $order->status == $status}selected{/if}>{$status|capitalize}</option>
                                    {/foreach}
                                </select>
                                <button type="submit">Save</button>
                            </form>
                        </div>
                    </td>
                </tr>
            {foreachelse}
                <tr><td colspan="6">No orders yet.</td></tr>
            {/foreach}
        </tbody>
    </table>
</div>
{/block}
