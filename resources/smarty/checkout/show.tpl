{extends file="layout.tpl"}
{block name=content}
<section class="checkout-grid">
    <div>
        <h1>Checkout</h1>
        <form method="post" action="/checkout" class="form-panel">
            <input type="hidden" name="_token" value="{$csrf}">
            <label>
                Shipping address
                <textarea name="shipping_address" rows="6" required>{$currentUser->name}, Lagos, Nigeria</textarea>
            </label>
            <button class="button" type="submit">Pay with Paystack</button>
        </form>
    </div>
    <aside class="order-summary">
        <h2>Order Summary</h2>
        {foreach $items as $item}
            <div class="summary-line">
                <span>{$item.name} x {$item.quantity}</span>
                <strong>&#8358;{$item.line_total|number_format:2}</strong>
            </div>
        {/foreach}
        <div class="summary-total">
            <span>Total</span>
            <strong>&#8358;{$cartTotal|number_format:2}</strong>
        </div>
    </aside>
</section>
{/block}
