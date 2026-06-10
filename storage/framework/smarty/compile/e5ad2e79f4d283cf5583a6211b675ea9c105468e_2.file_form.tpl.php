<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:04:02
  from 'file:admin/products/form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a29288253e0b8_64119512',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5ad2e79f4d283cf5583a6211b675ea9c105468e' => 
    array (
      0 => 'admin/products/form.tpl',
      1 => 1781044214,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a29288253e0b8_64119512 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12339718396a2928822f7fe2_21143858', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_12339718396a2928822f7fe2_21143858 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
?>

<?php $_smarty_tpl->assign('isEditing', $_smarty_tpl->getValue('product') != null, false, NULL);?>
<section class="section-head">
    <div>
        <h1><?php if ($_smarty_tpl->getValue('isEditing')) {?>Edit Product<?php } else { ?>Create Product<?php }?></h1>
        <p><?php if ($_smarty_tpl->getValue('isEditing')) {?>Update product details and add more images.<?php } else { ?>Upload one or more product images. The first image becomes the main catalog image.<?php }?></p>
    </div>
    <a class="button small" href="/admin/products">Back to Products</a>
</section>

<form method="post" action="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('formAction')), ENT_QUOTES, 'UTF-8');?>
" enctype="multipart/form-data" class="form-panel product-form" id="productForm">
    <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
    <?php if ($_smarty_tpl->getValue('formMethod') != 'POST') {?><input type="hidden" name="_method" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('formMethod')), ENT_QUOTES, 'UTF-8');?>
"><?php }?>

    <div class="form-grid">
        <label>
            Product name
            <input type="text" name="name" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['name'] ?? null)===null||$tmp==='' ? ((($tmp = $_smarty_tpl->getValue('product')->name ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
        </label>
        <label>
            Price
            <input type="number" name="price" min="0" step="0.01" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['price'] ?? null)===null||$tmp==='' ? ((($tmp = $_smarty_tpl->getValue('product')->price ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
        </label>
        <label>
            Stock
            <input type="number" name="stock" min="0" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['stock'] ?? null)===null||$tmp==='' ? ((($tmp = $_smarty_tpl->getValue('product')->stock ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
        </label>
    </div>

    <label>
        Description
        <textarea name="description" rows="6" required><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['description'] ?? null)===null||$tmp==='' ? ((($tmp = $_smarty_tpl->getValue('product')->description ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</textarea>
    </label>

    <?php if ($_smarty_tpl->getValue('isEditing')) {?>
        <label class="checkbox-label">
            <input type="checkbox" name="is_active" value="1" <?php if ((($tmp = $_smarty_tpl->getValue('oldInput')['is_active'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('product')->is_active ?? null : $tmp)) {?>checked<?php }?>>
            Active product
        </label>
    <?php }?>

    <label>
        <?php if ($_smarty_tpl->getValue('isEditing')) {?>Add more images<?php } else { ?>Product images<?php }?>
        <input type="file" name="images[]" accept="image/*" multiple <?php if (!$_smarty_tpl->getValue('isEditing')) {?>required<?php }?>>
    </label>

    <button class="button" type="submit" id="productSubmitButton" data-busy-text="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('busyText')), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('submitText')), ENT_QUOTES, 'UTF-8');?>
</button>
</form>

<?php if ($_smarty_tpl->getValue('isEditing')) {?>
    <section class="image-manager form-panel">
        <h2>Current Images</h2>
        <div class="admin-image-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('product')->images, 'image');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('image')->value) {
$foreach0DoElse = false;
?>
                <div class="admin-image-card">
                    <img src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('image')->url), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
 image">
                    <form method="post" action="/admin/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
/images/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('image')->id), ENT_QUOTES, 'UTF-8');?>
">
                        <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="danger small-button" type="submit">Delete Image</button>
                    </form>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    </section>
<?php }?>

<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
