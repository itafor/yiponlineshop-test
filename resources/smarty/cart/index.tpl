{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>Shopping Cart</h1>
        <p>Review quantities before checkout.</p>
    </div>
    {if $items|count}
        <div class="action-row">
            <a class="button" href="/checkout">Checkout</a>
            <a class="button secondary" href="/">Continue shopping</a>
        </div>
    {/if}
</section>

{if $items|count}
    <div class="cart-list">
        {foreach $items as $item}
            <article class="cart-item">
                <img src="{$item.image_url}" alt="{$item.name}">
                <div>
                    <h3>{$item.name}</h3>
                    <p>&#8358;{$item.price|number_format:2} each</p>
                </div>
                <form method="post" action="/cart/{$item.slug}" class="quantity-form">
                    <input type="hidden" name="_token" value="{$csrf}">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="number" name="quantity" min="0" max="20" value="{$item.quantity}">
                    <button type="submit">Update</button>
                </form>
                <strong>&#8358;{$item.line_total|number_format:2}</strong>
                <form method="post" action="/cart/{$item.slug}">
                    <input type="hidden" name="_token" value="{$csrf}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="danger" type="submit">Remove</button>
                </form>
            </article>
        {/foreach}
    </div>
    <div class="summary-bar">
        <span>Total</span>
        <strong>&#8358;{$cartTotal|number_format:2}</strong>
    </div>
{else}
    <div class="empty-state">
        <h2>Your cart is empty</h2>
        <a class="button" href="/">Browse Products</a>
    </div>
{/if}
{/block}
