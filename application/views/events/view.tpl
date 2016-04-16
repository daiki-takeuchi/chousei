{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <h1>予定</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    {$event_item['title']|escape}
                </div>
                <div class="panel-body">
                    {$event_item['title']|escape|nl2br|strip:""}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" onclick="history.back();">戻る</a>
            <a class="btn btn-primary" href="{site_url}events/edit/{$event_item['id']}">編集</a>
        </div>
    </div>
{/block}