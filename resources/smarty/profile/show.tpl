{extends file="layout.tpl"}
{block name=content}
<section class="section-head">
    <div>
        <h1>Profile</h1>
        <p>Update your name and email address.</p>
    </div>
</section>

<form method="post" action="/profile" class="form-panel profile-form">
    <input type="hidden" name="_token" value="{$csrf}">
    <input type="hidden" name="_method" value="PATCH">

    <label>
        Name
        <input type="text" name="name" value="{$oldInput.name|default:$currentUser->name}" required>
    </label>

    <label>
        Email address
        <input type="email" name="email" value="{$oldInput.email|default:$currentUser->email}" required>
    </label>

    <button class="button" type="submit">Update Profile</button>
</form>
{/block}
