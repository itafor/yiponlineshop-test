<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:32:14
  from 'file:admin/products/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a292f1e5abdb3_05293020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd720b539da4f59a916d422eb447ff94dd007ab6f' => 
    array (
      0 => 'admin/products/index.tpl',
      1 => 1781083924,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a292f1e5abdb3_05293020 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11652543266a292f1e576c32_54553679', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_11652543266a292f1e576c32_54553679 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin\\products';
?>

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
        <input type="search" name="search" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('filters')['search']), ENT_QUOTES, 'UTF-8');?>
" placeholder="Product name">
    </label>
    <label>
        Status
        <select name="status">
            <option value="" <?php if (!$_smarty_tpl->getValue('filters')['status']) {?>selected<?php }?>>All statuses</option>
            <option value="active" <?php if ($_smarty_tpl->getValue('filters')['status'] == 'active') {?>selected<?php }?>>Active</option>
            <option value="inactive" <?php if ($_smarty_tpl->getValue('filters')['status'] == 'inactive') {?>selected<?php }?>>Inactive</option>
        </select>
    </label>
    <button type="submit">Apply</button>
    <a class="button small" href="/admin/products">Reset</a>
</form>

<div class="table-wrap">
    <table>
        <thead><tr><th>Product</th><th>Price</th><th>Stock</th><th>Images</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td>
                        <div class="table-product">
                            <img src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->image_url), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
">
                            <div>
                                <a href="/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
</a>
                                <span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
</span>
                            </div>
                        </div>
                    </td>
                    <td>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->price,2)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->stock), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('product')->images)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php if ($_smarty_tpl->getValue('product')->is_active) {?>Active<?php } else { ?>Inactive<?php }?></td>
                    <td>
                        <div class="action-row">
                            <a class="button small" href="/admin/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
">View</a>
                            <a class="button small" href="/admin/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
/edit">Edit</a>
                            <form method="post" action="/admin/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="danger small-button" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php
}
if ($foreach0DoElse) {
?>
                <tr><td colspan="6">No products yet.</td></tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
</div>

<div class="pagination-bar">
    <span>
        <?php if ($_smarty_tpl->getValue('pagination')['total']) {?>
            Showing <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['from']), ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['to']), ENT_QUOTES, 'UTF-8');?>
 of <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['total']), ENT_QUOTES, 'UTF-8');?>
 products
        <?php } else { ?>
            No products found
        <?php }?>
    </span>
    <div class="pagination-actions">
        <?php if ($_smarty_tpl->getValue('pagination')['previousUrl']) {?>
            <a class="button small" href="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['previousUrl']), ENT_QUOTES, 'UTF-8');?>
">Previous</a>
        <?php } else { ?>
            <span class="button small disabled">Previous</span>
        <?php }?>
        <span>Page <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['currentPage']), ENT_QUOTES, 'UTF-8');?>
 of <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['lastPage']), ENT_QUOTES, 'UTF-8');?>
</span>
        <?php if ($_smarty_tpl->getValue('pagination')['nextUrl']) {?>
            <a class="button small" href="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('pagination')['nextUrl']), ENT_QUOTES, 'UTF-8');?>
">Next</a>
        <?php } else { ?>
            <span class="button small disabled">Next</span>
        <?php }?>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
