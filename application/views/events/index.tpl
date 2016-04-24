{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <div class="panel panel-default">
        <div class="panel-heading">
            {if $admin}
            <div align="right" style="float: right;">
            <a href="{site_url}events/create" style="font-size: small">
                <span class="glyphicon glyphicon-plus-sign"></span> 予定を追加
            </a>
            </div>
            {/if}
            予定一覧
            <div style="clear: both;"></div><!-- 回りこみ解除 -->
        </div>
        <div class="panel-body">
            <div class="row">
            {foreach from=$events item=event_item}
                <div class="col-xs-12 col-sm-6" style="padding-top:5px;">
                    {if $admin}
                    <a class="list-group-item" href="{site_url}events/edit/{$event_item['id']}">
                    {else}
                    <li class="list-group-item">
                    {/if}
                        <table style="word-break: break-all;">
                            <tr>
                                <td style="padding-left: 15px;">
                                    <h4>{$event_item['title']|escape}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 15px;">
                                    <p>{$event_item['start_time']|date_format:"%Y/%m/%d"}&nbsp;
                                    {$event_item['start_time']|date_format:"%H:%M"}
                                    ～
                                    {$event_item['end_time']|date_format:"%H:%M"}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 15px;">
                                    <p>{$event_item['place']|escape}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-left: 15px;">
                                    <p>
                                        募集 : {$event_item['number_of_people']}&nbsp;&nbsp;|&nbsp;
                                        残り : {$event_item['number_of_people'] - count($event_item['attendee'])}
                                    </p>
                                </td>
                            </tr>
                        </table>
                    {if $admin}</a>{else}</li>{/if}
                </div>
            {/foreach}
            </div>
        </div>
    </div>
    {$pagination}
{/block}