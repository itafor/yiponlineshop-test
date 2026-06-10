<?php
/* Smarty version 5.8.0, created on 2026-06-09 22:31:10
  from 'file:checkout/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a28942eccb569_58812081',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '877d31909aa5dfeff40a4925defeeda41e948397' => 
    array (
      0 => 'checkout/show.tpl',
      1 => 1781044214,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a28942eccb569_58812081 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\checkout';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15812291406a28942ecc2112_02457416', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_15812291406a28942ecc2112_02457416 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\checkout';
?>

<section class="checkout-grid">
    <div>
        <h1>Checkout</h1>
        <form method="post" action="/checkout" class="form-panel">
            <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
            <label>
                Shipping address
                <textarea name="shipping_address" rows="6" required><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('currentUser')->name), ENT_QUOTES, 'UTF-8');?>
, Lagos, Nigeria</textarea>
            </label>
            <button class="button" type="submit">Pay with Paystack</button>
        </form>
    </div>
    <aside class="order-summary">
        <h2>Order Summary</h2>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('items'), 'item');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach1DoElse = false;
?>
            <div class="summary-line">
                <span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['name']), ENT_QUOTES, 'UTF-8');?>
 x <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')['quantity']), ENT_QUOTES, 'UTF-8');?>
</span>
                <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['line_total'],2)), ENT_QUOTES, 'UTF-8');?>
</strong>
            </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        <div class="summary-total">
            <span>Total</span>
            <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('cartTotal'),2)), ENT_QUOTES, 'UTF-8');?>
</strong>
        </div>
    </aside>
</section>
<?php
}
}
/* {/block 'content'} */
}
