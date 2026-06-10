{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>View Product</h1>
        <p>Read-only product details for admin review.</p>
    </div>
    <div class="action-row">
        <a class="button small" href="/admin/products/{$product->slug}/edit">Update</a>
        <a class="button small" href="/admin/products">Back to Products</a>
    </div>
</section>

<section class="form-panel product-form readonly-panel">
    <div class="form-grid">
        <label>
            Product name
            <input type="text" value="{$product->name}" disabled>
        </label>
        <label>
            Price
            <input type="text" value="{$product->price|number_format:2}" disabled>
        </label>
        <label>
            Stock
            <input type="text" value="{$product->stock}" disabled>
        </label>
    </div>

    <label>
        Description
        <textarea rows="6" disabled>{$product->description}</textarea>
    </label>

    <label class="checkbox-label">
        <input type="checkbox" disabled {if $product->is_active}checked{/if}>
        Active product
    </label>
</section>

<section class="image-manager form-panel">
    <h2>Product Images</h2>
    <div class="admin-image-grid">
        {foreach $product->images as $image}
            <div class="admin-image-card">
                <img src="{$image->url}" alt="{$product->name} image">
            </div>
        {/foreach}
    </div>
</section>
{/block}
