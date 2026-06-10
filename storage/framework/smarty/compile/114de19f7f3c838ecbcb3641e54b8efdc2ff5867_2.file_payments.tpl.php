<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:27:09
  from 'file:admin/payments.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a292dedb39051_95492283',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '114de19f7f3c838ecbcb3641e54b8efdc2ff5867' => 
    array (
      0 => 'admin/payments.tpl',
      1 => 1781083594,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a292dedb39051_95492283 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8372727376a292dedb2d299_13970261', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_8372727376a292dedb2d299_13970261 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin';
?>

<section class="admin-metrics">
    <div><span>Payment Records</span><strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders'))), ENT_QUOTES, 'UTF-8');?>
</strong></div>
    <div><span>Paid Revenue</span><strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('paidRevenue'),2)), ENT_QUOTES, 'UTF-8');?>
</strong></div>
</section>

<section class="section-head">
    <div>
        <h1>Payment History</h1>
        <p>Paystack references and payment statuses across all orders.</p>
    </div>
</section>

<div class="table-wrap">
    <table>
        <thead><tr><th>Order</th><th>Customer</th><th>Reference</th><th>Amount</th><th>Status</th><th>Paid At</th><th>Action</th></tr></thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach3DoElse = false;
?>
                <tr>
                    <td><a href="/admin/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
">#<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
</a></td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->customer_name), ENT_QUOTES, 'UTF-8');?>
<br><span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->customer_email), ENT_QUOTES, 'UTF-8');?>
</span></td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->payment_reference), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('order')->total,2)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->payment_status)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php if ($_smarty_tpl->getValue('order')->paid_at) {
echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->paid_at), ENT_QUOTES, 'UTF-8');
} else { ?>-<?php }?></td>
                    <td><a class="button small" href="/admin/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
">View Order</a></td>
                </tr>
            <?php
}
if ($foreach3DoElse) {
?>
                <tr><td colspan="7">No payment records yet.</td></tr>
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
