<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:27:09
  from 'file:admin/orders.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a292ded465b04_87233296',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a861b1125a571ff524a2ff7c019beb755758da92' => 
    array (
      0 => 'admin/orders.tpl',
      1 => 1781083594,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a292ded465b04_87233296 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11460658306a292ded421360_72433724', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_11460658306a292ded421360_72433724 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin';
?>

<section class="admin-metrics">
    <div><span>Total Orders</span><strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('orders'))), ENT_QUOTES, 'UTF-8');?>
</strong></div>
    <div><span>Revenue</span><strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('revenue'),2)), ENT_QUOTES, 'UTF-8');?>
</strong></div>
</section>
<section class="section-head">
    <div>
        <h1>Admin Orders</h1>
        <p>Manage fulfillment status for customer orders.</p>
    </div>
</section>
<div class="table-wrap">
    <table>
        <thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Payment</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('orders'), 'order');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('order')->value) {
$foreach0DoElse = false;
?>
                <tr>
                    <td><a href="/admin/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
">#<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
</a></td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->customer_name), ENT_QUOTES, 'UTF-8');?>
<br><span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->customer_email), ENT_QUOTES, 'UTF-8');?>
</span></td>
                    <td>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('order')->total,2)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->payment_status)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->status)), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td>
                        <div class="action-row">
                            <a class="button small" href="/admin/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
">View</a>
                            <form method="post" action="/admin/orders/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
" class="status-form">
                                <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
                                <input type="hidden" name="_method" value="PATCH">
                                <select name="status">
                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array('pending','processing','shipped','completed','cancelled'), 'status');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('status')->value) {
$foreach1DoElse = false;
?>
                                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('status')), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->getValue('order')->status == $_smarty_tpl->getValue('status')) {?>selected<?php }?>><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('status'))), ENT_QUOTES, 'UTF-8');?>
</option>
                                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                </select>
                                <button type="submit">Save</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php
}
if ($foreach0DoElse) {
?>
                <tr><td colspan="6">No orders yet.</td></tr>
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
