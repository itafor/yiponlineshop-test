<?php
/* Smarty version 5.8.0, created on 2026-06-10 09:57:43
  from 'file:layout.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a293517d95008_35643552',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5734a1c359ca73c6abdf0fa2843743112f1e1a91' => 
    array (
      0 => 'layout.tpl',
      1 => 1781085437,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a293517d95008_35643552 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('title') ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('appName') ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</title>
    <link rel="stylesheet" href="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('assetBase')), ENT_QUOTES, 'UTF-8');?>
css/app.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="<?php if ($_smarty_tpl->getValue('currentUser') && $_smarty_tpl->getValue('currentUser')->is_admin) {?>/admin/products<?php } else { ?>/<?php }?>">YipOnline Shop</a>
        <nav class="nav">
            <?php if ($_smarty_tpl->getValue('currentUser')) {?>
                <?php if ($_smarty_tpl->getValue('currentUser')->is_admin) {?>
                    <a href="/admin/products">Products</a>
                    <a href="/admin/orders">Orders</a>
                    <a href="/admin/payments">Payments</a>
                <?php } else { ?>
                    <a href="/">Products</a>
                    <a href="/orders">Orders</a>
                    <a href="/cart">Cart (<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cartCount')), ENT_QUOTES, 'UTF-8');?>
)</a>
                <?php }?>
                <form method="post" action="/logout">
                    <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
                    <button type="submit" class="link-button">Logout</button>
                </form>
            <?php } else { ?>
                <a href="/">Products</a>
                <a href="/cart">Cart (<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('cartCount')), ENT_QUOTES, 'UTF-8');?>
)</a>
                <a href="/login">Login</a>
                <a class="button small" href="/register">Register</a>
            <?php }?>
        </nav>
    </header>

    <main class="page">
        <?php if ($_smarty_tpl->getValue('flashSuccess')) {?><div class="alert success"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('flashSuccess')), ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
        <?php if ($_smarty_tpl->getValue('flashError')) {?><div class="alert error"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('flashError')), ENT_QUOTES, 'UTF-8');?>
</div><?php }?>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('errorsBag'))) {?>
            <div class="alert error">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('errorsBag'), 'error');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('error')->value) {
$foreach0DoElse = false;
?><p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('error')), ENT_QUOTES, 'UTF-8');?>
</p><?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
        <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11690473876a293517d88395_11120661', 'content');
?>

    </main>
</body>
</html>
<?php }
/* {block 'content'} */
class Block_11690473876a293517d88395_11120661 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty';
}
}
/* {/block 'content'} */
}
