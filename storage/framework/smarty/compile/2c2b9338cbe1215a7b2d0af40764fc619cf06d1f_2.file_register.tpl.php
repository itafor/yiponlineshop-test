<?php
/* Smarty version 5.8.0, created on 2026-06-10 13:13:34
  from 'file:auth/register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2962fe515f81_65929593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c2b9338cbe1215a7b2d0af40764fc619cf06d1f' => 
    array (
      0 => 'auth/register.tpl',
      1 => 1781097181,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2962fe515f81_65929593 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\auth';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8183610926a2962fe507e55_13588382', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_8183610926a2962fe507e55_13588382 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\auth';
?>

<section class="auth-wrap">
    <form method="post" action="/register" class="form-panel">
        <h1>Create Account</h1>
        <p class="form-note">Use a real, active email address. Paystack may reject checkout payments from fake or invalid email addresses.</p>
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
