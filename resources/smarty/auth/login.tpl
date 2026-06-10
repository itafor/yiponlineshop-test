{extends file="layout.tpl"}
{block name=content}
<section class="auth-wrap">
    <form method="post" action="/login" class="form-panel">
        <h1>Login</h1>
        <input type="hidden" name="_token" value="{$csrf}">
        <label>Email <input type="email" name="email" value="customer@yiponline.test" required></label>
        <label>Password <input type="password" name="password" value="password123" required></label>
        <button class="button" type="submit">Login</button>
        <p>Admin demo: admin@yiponline.test / password123</p>
    </form>
</section>
{/block}
