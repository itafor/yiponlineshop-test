<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:48:05
  from 'file:cart/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2932d57f29e6_10222307',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ead0623a2f61f216538a3f98c67f877ce2ed439' => 
    array (
      0 => 'cart/index.tpl',
      1 => 1781084561,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2932d57f29e6_10222307 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\cart';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18303127416a2932d57d6644_36905001', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_18303127416a2932d57d6644_36905001 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\cart';
?>

<section class="section-head">
    <div>
        <h1>Shopping Cart</h1>
        <p>Review quantities before checkout.</p>
    </div>
    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('items'))) {?>
        <div class="action-row">
            <a class="button" href="/checkout">Checkout</a>
            <a class="button secondary" href="/">Continue shopping</a>
        </div>
    <?php }?>
</section>

<?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('items'))) {?>
    <div class="cart-list">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('items'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
            <article class="cart-item">
                <img src="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['image_url']), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['name']), ENT_QUOTES, 'UTF-8');?>
">
                <div>
                    <h3><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['name']), ENT_QUOTES, 'UTF-8');?>
</h3>
                    <p>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['price'],2)), ENT_QUOTES, 'UTF-8');?>
 each</p>
                </div>
                <form method="post" action="/cart/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['slug']), ENT_QUOTES, 'UTF-8');?>
" class="quantity-form">
                    <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="number" name="quantity" min="0" max="20" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['quantity']), ENT_QUOTES, 'UTF-8');?>
">
                    <button type="submit">Update</button>
                </form>
                <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['line_total'],2)), ENT_QUOTES, 'UTF-8');?>
</strong>
                <form method="post" action="/cart/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['slug']), ENT_QUOTES, 'UTF-8');?>
">
                    <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="danger" type="submit">Remove</button>
                </form>
            </article>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <div class="summary-bar">
        <span>Total</span>
        <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('cartTotal'),2)), ENT_QUOTES, 'UTF-8');?>
</strong>
    </div>
<?php } else { ?>
    <div class="empty-state">
        <h2>Your cart is empty</h2>
        <a class="button" href="/">Browse Products</a>
    </div>
<?php }
}
}
/* {/block 'content'} */
}
