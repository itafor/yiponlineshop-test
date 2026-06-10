<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$title|default:$appName}</title>
    <link rel="stylesheet" href="{$assetBase}css/app.css">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{if $currentUser && $currentUser->is_admin}/admin/products{else}/{/if}">YipOnline Shop</a>
        <nav class="nav">
            {if $currentUser}
                {if $currentUser->is_admin}
                    <a href="/admin/products">Products</a>
                    <a href="/admin/orders">Orders</a>
                    <a href="/admin/payments">Payments</a>
                {else}
                    <a href="/">Products</a>
                    <a href="/orders">Orders</a>
                    <a href="/cart">Cart ({$cartCount})</a>
                {/if}
                <form method="post" action="/logout">
                    <input type="hidden" name="_token" value="{$csrf}">
                    <button type="submit" class="link-button">Logout</button>
                </form>
            {else}
                <a href="/">Products</a>
                <a href="/cart">Cart ({$cartCount})</a>
                <a href="/login">Login</a>
                <a class="button small" href="/register">Register</a>
            {/if}
        </nav>
    </header>

    <main class="page">
        {if $flashSuccess}<div class="alert success">{$flashSuccess}</div>{/if}
        {if $flashError}<div class="alert error">{$flashError}</div>{/if}
        {if $errorsBag|count}
            <div class="alert error">
                {foreach $errorsBag as $error}<p>{$error}</p>{/foreach}
            </div>
        {/if}
        {block name=content}{/block}
    </main>
</body>
</html>
