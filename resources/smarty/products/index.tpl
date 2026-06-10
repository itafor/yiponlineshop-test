{extends file="layout.tpl"}
{block name=content}
<section class="hero">
    <div>
        <p class="eyebrow">Business growth marketplace</p>
        <h1>Tools and packs for teams building momentum.</h1>
        <p>Browse practical products, add them to cart, checkout securely, and let admins manage fulfillment.</p>
    </div>
    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1100&q=80" alt="Team planning products">
</section>

<section class="section-head">
    <div>
        <h2>Products</h2>
        <p>{$products|count} active products available</p>
    </div>
</section>

<div class="product-grid">
    {foreach $products as $product}
        <article class="product-card">
            <a href="/products/{$product->slug}">
                <img src="{$product->image_url}" alt="{$product->name}">
            </a>
            <div class="product-body">
                <div>
                    <h3><a href="/products/{$product->slug}">{$product->name}</a></h3>
                    <p>{$product->description|truncate:115}</p>
                </div>
                <div class="product-foot">
                    <strong>&#8358;{$product->price|number_format:2}</strong>
                    <span>{$product->stock} in stock</span>
                </div>
            </div>
        </article>
    {/foreach}
</div>
{/block}
