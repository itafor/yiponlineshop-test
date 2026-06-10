{extends file="layout.tpl"}
{block name=content}
{assign var=isEditing value=$product != null}
<section class="section-head">
    <div>
        <h1>{if $isEditing}Edit Product{else}Create Product{/if}</h1>
        <p>{if $isEditing}Update product details and add more images.{else}Upload one or more product images. The first image becomes the main catalog image.{/if}</p>
    </div>
    <a class="button small" href="/admin/products">Back to Products</a>
</section>

<form method="post" action="{$formAction}" enctype="multipart/form-data" class="form-panel product-form" id="productForm">
    <input type="hidden" name="_token" value="{$csrf}">
    {if $formMethod != 'POST'}<input type="hidden" name="_method" value="{$formMethod}">{/if}

    <div class="form-grid">
        <label>
            Product name
            <input type="text" name="name" value="{$oldInput.name|default:($product->name|default:'')}" required>
        </label>
        <label>
            Price
            <input type="number" name="price" min="0" step="0.01" value="{$oldInput.price|default:($product->price|default:'')}" required>
        </label>
        <label>
            Stock
            <input type="number" name="stock" min="0" value="{$oldInput.stock|default:($product->stock|default:'')}" required>
        </label>
    </div>

    <label>
        Description
        <textarea name="description" rows="6" required>{$oldInput.description|default:($product->description|default:'')}</textarea>
    </label>

    {if $isEditing}
        <label class="checkbox-label">
            <input type="checkbox" name="is_active" value="1" {if $oldInput.is_active|default:$product->is_active}checked{/if}>
            Active product
        </label>
    {/if}

    <label>
        {if $isEditing}Add more images{else}Product images{/if}
        <input type="file" name="images[]" accept="image/*" multiple {if !$isEditing}required{/if}>
    </label>

    <button class="button" type="submit" id="productSubmitButton" data-busy-text="{$busyText}">{$submitText}</button>
</form>

{if $isEditing}
    <section class="image-manager form-panel">
        <h2>Current Images</h2>
        <div class="admin-image-grid">
            {foreach $product->images as $image}
                <div class="admin-image-card">
                    <img src="{$image->url}" alt="{$product->name} image">
                    <form method="post" action="/admin/products/{$product->slug}/images/{$image->id}">
                        <input type="hidden" name="_token" value="{$csrf}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="danger small-button" type="submit">Delete Image</button>
                    </form>
                </div>
            {/foreach}
        </div>
    </section>
{/if}

<script>
    (function () {
        var form = document.getElementById('productForm');
        var button = document.getElementById('productSubmitButton');

        if (!form || !button) {
            return;
        }

        form.addEventListener('submit', function () {
            button.disabled = true;
            button.textContent = button.getAttribute('data-busy-text') || 'Saving...';
        });
    }());
</script>
{/block}
