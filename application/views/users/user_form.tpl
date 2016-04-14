{extends file='templates/application.tpl'}
{block name=title}
    {$title}
{/block}
{block name=main_contents}
    <h1>{$title}</h1>
    <form method="post" action="" accept-charset="utf-8">
        {include file='users/user_fields.tpl'}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <input type="submit" name="submit" class="btn btn-primary" value="登録" />
                <a class="btn btn-primary" onclick="history.back();">戻る</a>
                {if $admin && isset($user_item.id) && $user_id !== $user_item.id}
                <a type="button" class="btn btn-danger" href="{site_url}users/delete/{$user_item.id}">削除</a>
                {/if}
            </div>
        </div>
    </form>
{/block}