{extends file="layout.tpl"}
{block name=content}
<section class="product-detail">
    <div class="product-gallery">
        {assign var=activeImage value=$galleryImages[0]->url|default:$product->image_url}
        <div class="active-image-wrap">
            <button type="button" class="gallery-arrow" data-gallery-prev aria-label="Previous image">&#8249;</button>
            <img id="activeProductImage" class="active-product-image" src="{$activeImage}" alt="{$product->name}">
            <button type="button" class="gallery-arrow" data-gallery-next aria-label="Next image">&#8250;</button>
        </div>

        {if $galleryImages|count > 1}
            <div class="thumbnail-strip" data-gallery-thumbnails>
                {foreach $galleryImages as $image}
                    <button type="button" class="thumbnail-button {if $image@first}active{/if}" data-image-src="{$image->url}">
                        <img src="{$image->url}" alt="{$product->name} image {$image@iteration}">
                    </button>
                {/foreach}
            </div>
        {/if}
    </div>

    <div class="detail-copy">
        <p class="eyebrow">Product detail</p>
        <h1>{$product->name}</h1>
        <p>{$product->description}</p>
        <div class="price-row">
            <strong>&#8358;{$product->price|number_format:2}</strong>
            <span>{$product->stock} available</span>
        </div>
        <form class="inline-form" method="post" action="/cart/{$product->slug}">
            <input type="hidden" name="_token" value="{$csrf}">
            <label>
                Quantity
                <input type="number" name="quantity" min="1" max="{$product->stock}" value="1">
            </label>
            <button class="button" type="submit">Add to Cart</button>
        </form>
    </div>
</section>

<script>
    (function () {
        var activeImage = document.getElementById('activeProductImage');
        var buttons = Array.prototype.slice.call(document.querySelectorAll('[data-image-src]'));
        var current = 0;

        function showImage(index) {
            if (!activeImage || buttons.length === 0) {
                return;
            }

            current = (index + buttons.length) % buttons.length;
            activeImage.src = buttons[current].getAttribute('data-image-src');

            buttons.forEach(function (button, buttonIndex) {
                button.classList.toggle('active', buttonIndex === current);
            });
        }

        buttons.forEach(function (button, index) {
            button.addEventListener('click', function () {
                showImage(index);
            });
        });

        var previous = document.querySelector('[data-gallery-prev]');
        var next = document.querySelector('[data-gallery-next]');

        if (previous) {
            previous.addEventListener('click', function () {
                showImage(current - 1);
            });
        }

        if (next) {
            next.addEventListener('click', function () {
                showImage(current + 1);
            });
        }

    }());
</script>
{/block}
