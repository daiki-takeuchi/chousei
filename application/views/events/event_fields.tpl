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
                               value="{if isset($event_item.title)}{$event_item.title}{/if}" autocomplete="off" />
                    </div>
                </div>
                <span class="must rd5">必須</span>
                <label for="date">日程</label>
                <div class="row">
                    <div class="from-group col-xs-5 col-md-5 col-lg-5">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type="text" class="form-control" name="date" placeholder="日程"
                                   value="{if isset($event_item.start_time)}{$event_item.start_time|date_format:"%Y/%m/%d"}{/if}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-xs-7 col-md-2 col-lg-2">
                        <table>
                            <tr>
                                <td style="padding-top: 7px;">
                                    {html_options name=start_time values=$times output=$times selected=$event_item.start_time|date_format:"%H:%M"}
                                </td>
                                <td style="padding-bottom: 9px;margin-top: 0">&nbsp;〜&nbsp;</td>
                                <td style="padding-top: 7px;">
                                    {html_options name=end_time values=$times output=$times selected=$event_item.end_time|date_format:"%H:%M"}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="from-group">
                    <label for="place">場所</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-pushpin"></span>
                        </span>
                        <input type="text" class="form-control" name="place" placeholder="場所"
                               value="{if isset($event_item.place)}{$event_item.place}{/if}" autocomplete="off" />
                    </div>
                </div>
                <div class="from-group">
                    <label for="description">備考</label>
                    <div class='input-group' style="width: 100%;">
                        <textarea class="form-control" name="description" placeholder="備考">{if isset($event_item.description)}{$event_item.description}{/if}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>