{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div align="right" style="float: right;">
            <a href="{site_url}events/create" style="font-size: small">
                <span class="glyphicon glyphicon-plus-sign"></span> 予定を追加
            </a>
            </div>予定一覧
            <div style="clear: both;"></div><!-- 回りこみ解除 -->
        </div>
        <div class="panel-body">
            <div class="row">
            {foreach from=$events item=events_item}
                <div class="col-xs-12 col-sm-6" style="padding-top:5px;">
                    <a class="list-group-item" href="{site_url}events/edit/{$events_item['id']}">
                        <table style="word-break: break-all;">
                            <tr style="height:0"><td width="75px"></td><td width="100%"></td></tr>
                            <tr>
                                <td>
                                    <div class="panel" style="width: 55px height: 55px;">a
                                    </div>
                                </td>
                                <td style="padding-top: 7px; padding-left: 15px;">
                                    <p>{$events_item['title']|escape}</p>
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