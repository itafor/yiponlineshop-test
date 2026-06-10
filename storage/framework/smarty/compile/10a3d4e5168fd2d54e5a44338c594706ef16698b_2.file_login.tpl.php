<?php
/* Smarty version 5.8.0, created on 2026-06-09 21:13:26
  from 'file:auth/login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2881f6c8a1c5_80776368',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10a3d4e5168fd2d54e5a44338c594706ef16698b' => 
    array (
      0 => 'auth/login.tpl',
      1 => 1781038575,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2881f6c8a1c5_80776368 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\auth';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17432091406a2881f6c7f101_63197010', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_17432091406a2881f6c7f101_63197010 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\auth';
?>

<section class="auth-wrap">
    <form method="post" action="/login" class="form-panel">
        <h1>Login</h1>
        <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
        <label>Email <input type="email" name="email" value="customer@yiponline.test" required></label>
        <label>Password <input type="password" name="password" value="password123" required></label>
        <button class="button" type="submit">Login</button>
        <p>Admin demo: admin@yiponline.test / password123</p>
    </form>
</section>
<?php
}
}
/* {/block 'content'} */
}
