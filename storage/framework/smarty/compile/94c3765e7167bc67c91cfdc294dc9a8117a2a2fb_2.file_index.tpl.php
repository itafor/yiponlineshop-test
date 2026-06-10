<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:57:54
  from 'file:orders/index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a293522260013_09688425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94c3765e7167bc67c91cfdc294dc9a8117a2a2fb' => 
    array (
      0 => 'orders/index.tpl',
      1 => 1781085437,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a293522260013_09688425 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\orders';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18948625556a293522242d35_97065698', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_18948625556a293522242d35_97065698 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\orders';
?>

<section class="section-head">
    <div>
        <h1>My Orders</h1>
        <p>Track your orders, payment status, and fulfillment progress.</p>
    </div>
    <a class="button small" href="/">Continue shopping</a>
</section>

<div class="table-wrap">
    <table>
        <thead><tr><th>Order</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td>#<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('order')->total,2)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->payment_status)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->status)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->created_at), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><a class="button small" href="/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
">View</a></td>
                </tr>
            <?php
}
if ($foreach0DoElse) {
?>
                <tr><td colspan="6">You have not placed any orders yet.</td></tr>
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
