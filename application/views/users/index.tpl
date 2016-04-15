{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div align="right" style="float: right;">
            <a href="{site_url}users/create" style="font-size: small">
                <span class="glyphicon glyphicon-plus-sign"></span> メンバーを追加
            </a>
            </div>メンバー
            <div style="clear: both;"></div><!-- 回りこみ解除 -->
        </div>
        <div class="panel-body">
            <div class="row">
            {foreach from=$users item=users_item}
                <div class="col-xs-12 col-sm-6" style="padding-top:5px;">
                    <a class="list-group-item" href="{site_url}users/edit/{$users_item['id']}">
                        <table>
                            <tr style="height:0"><td width="75px"></td><td width="100%"></td></tr>
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
                </div>
            {/foreach}
            </div>
        </div>
    </div>
    {$pagination}
{/block}