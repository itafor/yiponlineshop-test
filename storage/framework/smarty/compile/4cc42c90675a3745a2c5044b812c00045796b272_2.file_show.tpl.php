<?php
/* Smarty version 5.8.0, created on 2026-06-09 22:53:23
  from 'file:products/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a28996357d805_69554613',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cc42c90675a3745a2c5044b812c00045796b272' => 
    array (
      0 => 'products/show.tpl',
      1 => 1781045551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a28996357d805_69554613 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2705299556a28996354cfc1_88876486', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_2705299556a28996354cfc1_88876486 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\products';
?>

<section class="product-detail">
    <div class="product-gallery">
        <?php $_smarty_tpl->assign('activeImage', (($tmp = $_smarty_tpl->getValue('galleryImages')[0]->url ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('product')->image_url ?? null : $tmp), false, NULL);?>
        <div class="active-image-wrap">
            <button type="button" class="gallery-arrow" data-gallery-prev aria-label="Previous image">&#8249;</button>
            <img id="activeProductImage" class="active-product-image" src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('activeImage')), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
">
            <button type="button" class="gallery-arrow" data-gallery-next aria-label="Next image">&#8250;</button>
        </div>

        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('galleryImages')) > 1) {?>
            <div class="thumbnail-strip" data-gallery-thumbnails>
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('galleryImages'), 'image');
$_smarty_tpl->getVariable('image')->iteration = 0;
$_smarty_tpl->getVariable('image')->index = -1;
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('image')->value) {
$foreach1DoElse = false;
$_smarty_tpl->getVariable('image')->iteration++;
$_smarty_tpl->getVariable('image')->index++;
$_smarty_tpl->getVariable('image')->first = !$_smarty_tpl->getVariable('image')->index;
$foreach1Backup = clone $_smarty_tpl->getVariable('image');
?>
                    <button type="button" class="thumbnail-button <?php if ($_smarty_tpl->getVariable('image')->first) {?>active<?php }?>" data-image-src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('image')->url), ENT_QUOTES, 'UTF-8');?>
">
                        <img src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('image')->url), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
 image <?php echo htmlspecialchars((string) ($_smarty_tpl->getVariable('image')->iteration), ENT_QUOTES, 'UTF-8');?>
">
                    </button>
                <?php
$_smarty_tpl->setVariable('image', $foreach1Backup);
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </div>

    <div class="detail-copy">
        <p class="eyebrow">Product detail</p>
        <h1><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
</h1>
        <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->description), ENT_QUOTES, 'UTF-8');?>
</p>
        <div class="price-row">
            <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->price,2)), ENT_QUOTES, 'UTF-8');?>
</strong>
            <span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->stock), ENT_QUOTES, 'UTF-8');?>
 available</span>
        </div>
        <form class="inline-form" method="post" action="/cart/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
">
            <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
            <label>
                Quantity
                <input type="number" name="quantity" min="1" max="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->stock), ENT_QUOTES, 'UTF-8');?>
" value="1">
            </label>
            <button class="button" type="submit">Add to Cart</button>
        </form>
    </div>
</section>

<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
