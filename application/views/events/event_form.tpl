{extends file='templates/application.tpl'}
{block name=title}{$title}{/block}
{block name=main_contents}
    <form method="post" action="" accept-charset="utf-8">
        {include file='events/event_fields.tpl'}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button name="submit" class="btn btn-primary">登録</button>
                <a class="btn btn-primary" onclick="history.back();">戻る</a>
                {if $admin && isset($event_item.id)}
                <a type="button" class="btn btn-danger" href="{site_url}events/delete/{$event_item.id}">削除</a>
                {/if}
            </div>
        </div>
    </form>
{/block}