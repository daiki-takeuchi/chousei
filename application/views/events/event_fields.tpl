<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">{$title}</div>
            <div class="panel-body">
                <div class="from-group">
                    <span class="must rd5">必須</span>
                    <label for="title">タイトル</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </span>
                        <input type="text" class="form-control" name="title" placeholder="タイトル"
                               value="{if isset($event_item.title)}{$event_item.title}{/if}" />
                    </div>
                </div>
                <span class="must rd5">必須</span>
                <label for="date">日程</label>
                <div class="row">
                    <div class="from-group col-xs-12 col-sm-5 col-md-5 col-lg-5">
                        <div class='input-group date'>
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            <input type="text" class="form-control" name="date" placeholder="日程"
                                   value="{if isset($event_item.start_time)}{$event_item.start_time|date_format:"%Y/%m/%d"}{/if}" readonly />
                        </div>
                    </div>
                    <div class="from-group col-xs-12 col-sm-7 col-md-2 col-lg-2">
                        <table>
                            <tr>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control clockpicker" name="start_time"
                                               value="{if isset($event_item.start_time)}{$event_item.start_time|date_format:"%H:%M"}{else}18:00{/if}" readonly />
                                            <span class="input-group-addon">
                                                <span class="fa fa-clock-o"></span>
                                            </span>
                                    </div>
                                </td>
                                <td>&nbsp;～&nbsp;</td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input type="text" class="form-control clockpicker" name="end_time"
                                               value="{if isset($event_item.end_time)}{$event_item.end_time|date_format:"%H:%M"}{else}20:00{/if}" readonly />
                                            <span class="input-group-addon">
                                                <span class="fa fa-clock-o"></span>
                                            </span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="from-group">
                    <label for="place">場所</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="fa fa-map-marker"></span>
                        </span>
                        <input type="text" class="form-control" name="place" placeholder="場所を入力してください。"
                               value="{if isset($event_item.place)}{$event_item.place}{/if}" />
                    </div>
                </div>
                <div class="from-group">
                    <span class="must rd5">必須</span>
                    <label for="number_of_people">募集人数</label>
                    <div class='input-group spinner'>
                        <span class="input-group-addon">
                            <span class="fa fa-user"></span>
                        </span>
                        <input type="number" class="form-control" name="number_of_people" min="1" 
                               value="{if isset($event_item.number_of_people)}{$event_item.number_of_people}{else}15{/if}" />
                        <div class="input-group-btn-vertical">
                            <button class="btn btn-default" type="button"><span class="fa fa-caret-up"></span></button>
                            <button class="btn btn-default" type="button"><span class="fa fa-caret-down"></span></button>
                        </div>
                    </div>
                </div>
                <div class="from-group">
                    <label for="participant">参加者</label>
                    <div class='input-group'>
                        <div id="attendee">
                        {foreach from=$event_item.attendee item=attendee}
                            <p class="small" id="user-{$attendee.user_id}">{if $attendee.name}{$attendee.name}{else}{$attendee.user_name}{/if} => {$status[$attendee.status]}</p>
                        {/foreach}
                        </div>
                    <a href="javascript:void(0)" onclick="userSelect(); return false;" class="small">
                        <span class="fa fa-user-plus"></span> 参加者を追加
                    </a>
                    </div>
                </div>
                <div class="from-group">
                    <label for="description">備考</label>
                    <div class='input-group' style="width: 100%;">
                        <textarea class="form-control" name="description" placeholder="備考を入力してください。">{if isset($event_item.description)}{$event_item.description}{/if}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>