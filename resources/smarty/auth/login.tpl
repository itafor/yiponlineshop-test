{extends file="layout.tpl"}
{block name=content}
<section class="auth-wrap">
    <form method="post" action="/login" class="form-panel">
        <h1>Login</h1>
        <input type="hidden" name="_token" value="{$csrf}">
        <label>Email <input type="email" name="email" value="{$demoAccounts.customer_email}" required></label>
        <label>Password <input type="password" name="password" value="{$demoAccounts.password}" required></label>
        <button class="button" type="submit">Login</button>
        <p>Admin demo: {$demoAccounts.admin_email} / {$demoAccounts.password}</p>
    </form>
</section>
{/block}
