<?php
/* Smarty version 5.8.0, created on 2026-06-09 22:49:04
  from 'file:orders/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2898601d9f95_77189669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0d32c4b6d89ee2f7293490717e9986fde4f436c' => 
    array (
      0 => 'orders/show.tpl',
      1 => 1781044214,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2898601d9f95_77189669 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\orders';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17571864696a2898601a2d60_74917873', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_17571864696a2898601a2d60_74917873 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\orders';
?>

<section class="section-head">
    <div>
        <h1>Order #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
</h1>
        <p>Status: <?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->status)), ENT_QUOTES, 'UTF-8');?>
 | Payment: <?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->payment_status)), ENT_QUOTES, 'UTF-8');?>
</p>
    </div>
    <strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('order')->total,2)), ENT_QUOTES, 'UTF-8');?>
</strong>
</section>
<?php if ($_smarty_tpl->getValue('order')->payment_status != 'paid' && !$_smarty_tpl->getValue('currentUser')->is_admin) {?>
    <form method="post" action="/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
/pay" class="payment-retry">
        <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
        <button class="button" type="submit">Pay with Paystack</button>
    </form>
<?php }?>
<div class="table-wrap">
    <table>
        <thead><tr><th>Item</th><th>Qty</th><th>Unit</th><th>Total</th></tr></thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order')->items, 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')->product_name), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')->quantity), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')->unit_price,2)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')->line_total,2)), ENT_QUOTES, 'UTF-8');?>
</td>
                </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
</div>
<?php
}
}
/* {/block 'content'} */
}
