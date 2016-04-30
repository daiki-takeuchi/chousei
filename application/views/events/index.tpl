{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <div class="panel panel-default">
        <div class="panel-heading">
            {if $admin}
            <div align="right" style="float: right;">
            <a href="{site_url}events/create" style="font-size: small">
                <span class="fa fa-calendar-plus-o"></span> 予定を追加
            </a>
            </div>
            {/if}
            予定一覧
            <div style="clear: both;"></div><!-- 回りこみ解除 -->
        </div>
        <div class="panel-body">
            <div class="row">
            {foreach from=$events item=event_item}
                <div class="col-xs-12 col-sm-6">
                    <div class="panel panel-default" id="{$event_item['id']}">
                        <div class="panel-body">
                            <h4>
                                {if $admin}<a href="{site_url}events/edit/{$event_item['id']}">{/if}
                                    {$event_item['title']|escape}
                                    {if $admin}</a>{/if}
                            </h4>
                            <p>{$event_item['start_time']|date_format:"%Y/%m/%d"}&nbsp;
                                {$event_item['start_time']|date_format:"%H:%M"}
                                ～
                                {$event_item['end_time']|date_format:"%H:%M"}
                            </p>
                            <p>{$event_item['place']|escape}</p>
                            {if empty($event_item['description'])}<div style="height: 26px;">{/if}
                                <article><p>{$event_item['description']|escape|nl2br}</p></article>
                            {if empty($event_item['description'])}</div>{/if}
                            <br />
                            <p class="remain">
                                募集 : {$event_item['number_of_people']}&nbsp;&nbsp;|&nbsp;
                                残り : {$event_item['number_of_people'] - $event_item['attend_count']}
                            </p>
                        </div>
                        <div class="panel-footer bg-white" style="height: 50px;">
                            {if array_key_exists("status", $event_item)}
                            <a class="btn btn-sm btn-{$event_item["btn-attendance"]} btn-attendance">参加</a>
                            <a class="btn btn-sm btn-{$event_item["btn-absence"]} btn-absence">欠席</a>
                            {else}
                                <p style="padding-top: 10px;">このイベントには参加できません。</p>
                            {/if}
                        </div>
                    </div>
                </div>
            {/foreach}
            </div>
        </div>
    </div>
    {$pagination}
{/block}