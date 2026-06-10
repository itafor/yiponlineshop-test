{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>Admin Products</h1>
        <p>Create products and upload multiple Cloudinary images.</p>
    </div>
    <a class="button" href="/admin/products/create">Add Product</a>
</section>

<form method="get" action="/admin/products" class="filter-bar">
    <label>
        Search
        <input type="search" name="search" value="{$filters.search}" placeholder="Product name">
    </label>
    <label>
        Status
        <select name="status">
            <option value="" {if !$filters.status}selected{/if}>All statuses</option>
            <option value="active" {if $filters.status == 'active'}selected{/if}>Active</option>
            <option value="inactive" {if $filters.status == 'inactive'}selected{/if}>Inactive</option>
        </select>
    </label>
    <button type="submit">Apply</button>
    <a class="button small" href="/admin/products">Reset</a>
</form>

<div class="table-wrap">
    <table>
        <thead><tr><th>Product</th><th>Price</th><th>Stock</th><th>Images</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            {foreach $products as $product}
                <tr>
                    <td>
                        <div class="table-product">
                            <img src="{$product->image_url}" alt="{$product->name}">
                            <div>
                                <a href="/products/{$product->slug}">{$product->name}</a>
                                <span>{$product->slug}</span>
                            </div>
                        </div>
                    </td>
                    <td>&#8358;{$product->price|number_format:2}</td>
                    <td>{$product->stock}</td>
                    <td>{$product->images|count}</td>
                    <td>{if $product->is_active}Active{else}Inactive{/if}</td>
                    <td>
                        <div class="action-row">
                            <a class="button small" href="/admin/products/{$product->slug}">View</a>
                            <a class="button small" href="/admin/products/{$product->slug}/edit">Edit</a>
                            <form method="post" action="/admin/products/{$product->slug}" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="_token" value="{$csrf}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="danger small-button" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            {foreachelse}
                <tr><td colspan="6">No products yet.</td></tr>
            {/foreach}
        </tbody>
    </table>
</div>

<div class="pagination-bar">
    <span>
        {if $pagination.total}
            Showing {$pagination.from} - {$pagination.to} of {$pagination.total} products
        {else}
            No products found
        {/if}
    </span>
    <div class="pagination-actions">
        {if $pagination.previousUrl}
            <a class="button small" href="{$pagination.previousUrl}">Previous</a>
        {else}
            <span class="button small disabled">Previous</span>
        {/if}
        <span>Page {$pagination.currentPage} of {$pagination.lastPage}</span>
        {if $pagination.nextUrl}
            <a class="button small" href="{$pagination.nextUrl}">Next</a>
        {else}
            <span class="button small disabled">Next</span>
        {/if}
    </div>
</div>
{/block}
