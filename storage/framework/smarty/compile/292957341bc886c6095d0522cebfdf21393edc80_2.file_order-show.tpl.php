<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:27:09
  from 'file:admin/order-show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a292ded7f2415_58356938',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '292957341bc886c6095d0522cebfdf21393edc80' => 
    array (
      0 => 'admin/order-show.tpl',
      1 => 1781083594,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a292ded7f2415_58356938 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4719415526a292ded7a1e00_98348663', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_4719415526a292ded7a1e00_98348663 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\admin';
?>

<section class="section-head">
    <div>
        <h1>Order #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->id), ENT_QUOTES, 'UTF-8');?>
</h1>
        <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->customer_name), ENT_QUOTES, 'UTF-8');?>
 | <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->customer_email), ENT_QUOTES, 'UTF-8');?>
</p>
    </div>
    <a class="button small" href="/admin/orders">Back to Orders</a>
</section>

<section class="admin-metrics">
    <div><span>Total</span><strong>&#8358;<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('order')->total,2)), ENT_QUOTES, 'UTF-8');?>
</strong></div>
    <div><span>Payment</span><strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->payment_status)), ENT_QUOTES, 'UTF-8');?>
</strong></div>
</section>

<section class="form-panel order-detail-panel">
    <p><strong>Status:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->status)), ENT_QUOTES, 'UTF-8');?>
</p>
    <p><strong>Shipping address:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->shipping_address), ENT_QUOTES, 'UTF-8');?>
</p>
</section>

<section class="form-panel order-detail-panel">
    <h2>Payment Details</h2>
    <p><strong>Payment status:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('capitalize')($_smarty_tpl->getValue('order')->payment_status)), ENT_QUOTES, 'UTF-8');?>
</p>
    <p><strong>Payment reference:</strong> <?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('order')->payment_reference ?? null)===null||$tmp==='' ? 'Not available' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</p>
    <p><strong>Authorization URL:</strong> <?php if ($_smarty_tpl->getValue('order')->payment_authorization_url) {?><a href="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->payment_authorization_url), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->payment_authorization_url), ENT_QUOTES, 'UTF-8');?>
</a><?php } else { ?>Not available<?php }?></p>
    <p><strong>Paid at:</strong> <?php if ($_smarty_tpl->getValue('order')->paid_at) {
echo htmlspecialchars((string) ($_smarty_tpl->getValue('order')->paid_at), ENT_QUOTES, 'UTF-8');
} else { ?>Not paid<?php }?></p>
</section>

<div class="table-wrap">
    <table>
        <thead><tr><th>Product</th><th>Product ID</th><th>Qty</th><th>Unit Price</th><th>Line Total</th></tr></thead>
        <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('order')->items, 'item');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach2DoElse = false;
?>
                <tr>
                    <td><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')->product_name), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php if ($_smarty_tpl->getValue('item')->product_id) {
echo htmlspecialchars((string) ($_smarty_tpl->getValue('item')->product_id), ENT_QUOTES, 'UTF-8');
} else { ?>-<?php }?></td>
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
