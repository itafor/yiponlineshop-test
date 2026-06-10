{extends file="layout.tpl"}
{block name=content}
<section class="auth-wrap">
    <form method="post" action="/register" class="form-panel">
        <h1>Create Account</h1>
        <input type="hidden" name="_token" value="{$csrf}">
        <label>Name <input type="text" name="name" required></label>
        <label>Email <input type="email" name="email" required></label>
        <label>Password <input type="password" name="password" required></label>
        <label>Confirm password <input type="password" name="password_confirmation" required></label>
        <button class="button" type="submit">Register</button>
    </form>
</section>
{/block}
