{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <div class="row">
        <div class="col-md-12">
            <div class="list-group">
                {foreach from=$users item=users_item}
                <a class="list-group-item" href="{site_url}users/edit/{$users_item['id']}">
                    <table>
                        <tr style="height:0"><td width="75"></td><td width="100%"></td></tr>
                        <tr>
                            <td>
                                <img alt="{$users_item['name']|escape}" class="img-circle" src="{site_url}assets/images/avatar.png" width="55" height="55" />
                            </td>
                            <td style="padding-top: 7px; padding-left: 15px;">
                                <p>{$users_item['name']|escape}</p>
                                <p>{$users_item['email']|escape}</p>
                            </td>
                        </tr>
                    </table>
                </a>
                {/foreach}
            </div>
            {$pagination}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{site_url}users/create">登録</a>
        </div>
    </div>
{/block}