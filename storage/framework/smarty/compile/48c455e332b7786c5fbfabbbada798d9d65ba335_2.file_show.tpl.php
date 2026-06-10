<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:10:00
  from 'file:admin/products/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2929e831db61_38643731',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48c455e332b7786c5fbfabbbada798d9d65ba335' => 
    array (
      0 => 'admin/products/show.tpl',
      1 => 1781082568,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2929e831db61_38643731 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20216334436a2929e8300fa9_71040818', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_20216334436a2929e8300fa9_71040818 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
?>

<section class="section-head">
    <div>
        <h1>View Product</h1>
        <p>Read-only product details for admin review.</p>
    </div>
    <div class="action-row">
        <a class="button small" href="/admin/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
/edit">Update</a>
        <a class="button small" href="/admin/products">Back to Products</a>
    </div>
</section>

<section class="form-panel product-form readonly-panel">
    <div class="form-grid">
        <label>
            Product name
            <input type="text" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
" disabled>
        </label>
        <label>
            Price
            <input type="text" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->price,2)), ENT_QUOTES, 'UTF-8');?>
" disabled>
        </label>
        <label>
            Stock
            <input type="text" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->stock), ENT_QUOTES, 'UTF-8');?>
" disabled>
        </label>
    </div>

    <label>
        Description
        <textarea rows="6" disabled><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->description), ENT_QUOTES, 'UTF-8');?>
</textarea>
    </label>

    <label class="checkbox-label">
        <input type="checkbox" disabled <?php if ($_smarty_tpl->getValue('product')->is_active) {?>checked<?php }?>>
        Active product
    </label>
</section>

<section class="image-manager form-panel">
    <h2>Product Images</h2>
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
            </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
</section>
<?php
}
}
/* {/block 'content'} */
}
