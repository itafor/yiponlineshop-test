{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>Order #{$order->id}</h1>
        <p>{$order->customer_name} | {$order->customer_email}</p>
    </div>
    <a class="button small" href="/admin/orders">Back to Orders</a>
</section>

<section class="admin-metrics">
    <div><span>Total</span><strong>&#8358;{$order->total|number_format:2}</strong></div>
    <div><span>Payment</span><strong>{$order->payment_status|capitalize}</strong></div>
</section>

<section class="form-panel order-detail-panel">
    <p><strong>Status:</strong> {$order->status|capitalize}</p>
    <p><strong>Shipping address:</strong> {$order->shipping_address}</p>
</section>

<section class="form-panel order-detail-panel">
    <h2>Payment Details</h2>
    <p><strong>Payment status:</strong> {$order->payment_status|capitalize}</p>
    <p><strong>Payment reference:</strong> {$order->payment_reference|default:'Not available'}</p>
    <p><strong>Authorization URL:</strong> {if $order->payment_authorization_url}<a href="{$order->payment_authorization_url}">{$order->payment_authorization_url}</a>{else}Not available{/if}</p>
    <p><strong>Paid at:</strong> {if $order->paid_at}{$order->paid_at}{else}Not paid{/if}</p>
</section>

<div class="table-wrap">
    <table>
        <thead><tr><th>Product</th><th>Product ID</th><th>Qty</th><th>Unit Price</th><th>Line Total</th></tr></thead>
        <tbody>
            {foreach $order->items as $item}
                <tr>
                    <td>{$item->product_name}</td>
                    <td>{if $item->product_id}{$item->product_id}{else}-{/if}</td>
                    <td>{$item->quantity}</td>
                    <td>&#8358;{$item->unit_price|number_format:2}</td>
                    <td>&#8358;{$item->line_total|number_format:2}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>
{/block}
