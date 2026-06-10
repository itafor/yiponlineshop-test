<?php
/* Smarty version 5.8.0, created on 2026-06-09 20:58:41
  from 'file:products/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a287e818e7de0_41137266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea339fd9a54036b45ec4936d0a08d2c6f7d1f303' => 
    array (
      0 => 'products/index.tpl',
      1 => 1781038574,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a287e818e7de0_41137266 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\products';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4207898146a287e818bee95_67734477', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_4207898146a287e818bee95_67734477 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\products';
?>

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
        <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('products'))), ENT_QUOTES, 'UTF-8');?>
 active products available</p>
    </div>
</section>

<div class="product-grid">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('products'), 'product');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('product')->value) {
$foreach0DoElse = false;
?>
        <article class="product-card">
            <a href="/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
">
                <img src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->image_url), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
">
            </a>
            <div class="product-body">
                <div>
                    <h3><a href="/products/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->slug), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->name), ENT_QUOTES, 'UTF-8');?>
</a></h3>
                    <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('product')->description,115)), ENT_QUOTES, 'UTF-8');?>
</p>
                </div>
                <div class="product-foot">
                    <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('product')->price,2)), ENT_QUOTES, 'UTF-8');?>
</strong>
                    <span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('product')->stock), ENT_QUOTES, 'UTF-8');?>
 in stock</span>
                </div>
            </div>
        </article>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>
<?php
}
}
/* {/block 'content'} */
}
