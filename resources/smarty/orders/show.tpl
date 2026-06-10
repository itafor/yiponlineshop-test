{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>Order #{$order->id}</h1>
        <p>Status: {$order->status|capitalize} | Payment: {$order->payment_status|capitalize}</p>
    </div>
    <strong>&#8358;{$order->total|number_format:2}</strong>
</section>
{if $order->payment_status != 'paid' && !$currentUser->is_admin}
    <form method="post" action="/orders/{$order->id}/pay" class="payment-retry">
        <input type="hidden" name="_token" value="{$csrf}">
        <button class="button" type="submit">Pay with Paystack</button>
    </form>
{/if}
<div class="table-wrap">
    <table>
        <thead><tr><th>Item</th><th>Qty</th><th>Unit</th><th>Total</th></tr></thead>
        <tbody>
            {foreach $order->items as $item}
                <tr>
                    <td>{$item->product_name}</td>
                    <td>{$item->quantity}</td>
                    <td>&#8358;{$item->unit_price|number_format:2}</td>
                    <td>&#8358;{$item->line_total|number_format:2}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>
{/block}
