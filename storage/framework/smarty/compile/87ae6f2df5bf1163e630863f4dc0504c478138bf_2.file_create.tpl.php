<?php
/* Smarty version 5.8.0, created on 2026-06-09 22:16:21
  from 'file:admin/products/create.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2890b588cf80_96331286',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87ae6f2df5bf1163e630863f4dc0504c478138bf' => 
    array (
      0 => 'admin/products/create.tpl',
      1 => 1781043188,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2890b588cf80_96331286 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12928876856a2890b5878196_28581678', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_12928876856a2890b5878196_28581678 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
?>

<section class="section-head">
    <div>
        <h1>Create Product</h1>
        <p>Upload one or more product images. The first image becomes the main catalog image.</p>
    </div>
</section>

<form method="post" action="/admin/products" enctype="multipart/form-data" class="form-panel product-form" id="createProductForm">
    <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">

    <div class="form-grid">
        <label>
            Product name
            <input type="text" name="name" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['name'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
        </label>
        <label>
            Price
            <input type="number" name="price" min="0" step="0.01" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['price'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
        </label>
        <label>
            Stock
            <input type="number" name="stock" min="0" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['stock'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
        </label>
    </div>

    <label>
        Description
        <textarea name="description" rows="6" required><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['description'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</textarea>
    </label>

    <label>
        Product images
        <input type="file" name="images[]" accept="image/*" multiple required>
    </label>

    <button class="button" type="submit" id="createProductButton">Create Product</button>
</form>

<?php echo '<script'; ?>
>
    (function () {
        var form = document.getElementById('createProductForm');
        var button = document.getElementById('createProductButton');

        if (!form || !button) {
            return;
        }

        form.addEventListener('submit', function () {
            button.disabled = true;
            button.textContent = 'Creating product...';
        });
    }());
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
