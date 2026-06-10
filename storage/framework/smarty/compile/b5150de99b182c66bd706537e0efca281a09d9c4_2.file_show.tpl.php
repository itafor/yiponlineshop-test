<?php
/* Smarty version 5.8.0, created on 2026-06-10 12:05:30
  from 'file:profile/show.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a29530aa81d47_33998996',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5150de99b182c66bd706537e0efca281a09d9c4' => 
    array (
      0 => 'profile/show.tpl',
      1 => 1781093042,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a29530aa81d47_33998996 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\profile';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7234390826a29530aa6d335_72803494', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, "layout.tpl", $_smarty_current_dir);
}
/* {block 'content'} */
class Block_7234390826a29530aa6d335_72803494 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\YIPONLINE\\resources\\smarty\\profile';
?>

<section class="section-head">
    <div>
        <h1>Profile</h1>
        <p>Update your name and email address.</p>
    </div>
</section>

<form method="post" action="/profile" class="form-panel profile-form">
    <input type="hidden" name="_token" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('csrf')), ENT_QUOTES, 'UTF-8');?>
">
    <input type="hidden" name="_method" value="PATCH">

    <label>
        Name
        <input type="text" name="name" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['name'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('currentUser')->name ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
    </label>

    <label>
        Email address
        <input type="email" name="email" value="<?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('oldInput')['email'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('currentUser')->email ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
" required>
    </label>

    <button class="button" type="submit">Update Profile</button>
</form>
<?php
}
}
/* {/block 'content'} */
}
