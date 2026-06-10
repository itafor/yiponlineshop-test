<?php
/* Smarty version 5.8.0, created on 2026-06-09 21:16:12
  from 'file:auth/register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a28829c4ccb01_91284930',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c2b9338cbe1215a7b2d0af40764fc619cf06d1f' => 
    array (
      0 => 'auth/register.tpl',
      1 => 1781038575,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a28829c4ccb01_91284930 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\auth';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17293497816a28829c4c4dc0_66552081', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_17293497816a28829c4c4dc0_66552081 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\auth';
?>

<section class="auth-wrap">
    <form method="post" action="/register" class="form-panel">
        <h1>Create Account</h1>
        <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
        <label>Name <input type="text" name="name" required></label>
        <label>Email <input type="email" name="email" required></label>
        <label>Password <input type="password" name="password" required></label>
        <label>Confirm password <input type="password" name="password_confirmation" required></label>
        <button class="button" type="submit">Register</button>
    </form>
</section>
<?php
}
}
/* {/block 'content'} */
}
