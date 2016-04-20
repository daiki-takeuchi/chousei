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
                    <div class="from-group col-xs-6 col-md-5 col-lg-4">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input type="text" class="form-control" name="date" placeholder="日程"
                                   value="{if isset($event_item.start_time)}{$event_item.start_time}{/if}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-xs-2 col-md-2 col-lg-2">
                        <select name="time">
                            <option value="00:00" >0:00</option>
                            <option value="00:30" >0:30</option>
                            <option value="01:00" >1:00</option>
                            <option value="01:30" >1:30</option>
                            <option value="02:00" >2:00</option>
                            <option value="02:30" >2:30</option>
                            <option value="03:00" >3:00</option>
                            <option value="03:30" >3:30</option>
                            <option value="04:00" >4:00</option>
                            <option value="04:30" >4:30</option>
                            <option value="05:00" >5:00</option>
                            <option value="05:30" >5:30</option>
                            <option value="06:00" >6:00</option>
                            <option value="06:30" >6:30</option>
                            <option value="07:00" >7:00</option>
                            <option value="07:30" >7:30</option>
                            <option value="08:00" >8:00</option>
                            <option value="08:30" >8:30</option>
                            <option value="09:00" >9:00</option>
                            <option value="09:30" >9:30</option>
                            <option value="10:00" >10:00</option>
                            <option value="10:30" >10:30</option>
                            <option value="11:00" >11:00</option>
                            <option value="11:30" >11:30</option>
                            <option value="12:00" >12:00</option>
                            <option value="12:30" >12:30</option>
                            <option value="13:00" >13:00</option>
                            <option value="13:30" >13:30</option>
                            <option value="14:00" >14:00</option>
                            <option value="14:30" >14:30</option>
                            <option value="15:00" >15:00</option>
                            <option value="15:30" >15:30</option>
                            <option value="16:00" >16:00</option>
                            <option value="16:30" >16:30</option>
                            <option value="17:00" >17:00</option>
                            <option value="17:30" >17:30</option>
                            <option value="18:00" >18:00</option>
                            <option value="18:30" >18:30</option>
                            <option value="19:00" selected>19:00</option>
                            <option value="19:30" >19:30</option>
                            <option value="20:00" >20:00</option>
                            <option value="20:30" >20:30</option>
                            <option value="21:00" >21:00</option>
                            <option value="21:30" >21:30</option>
                            <option value="22:00" >22:00</option>
                            <option value="22:30" >22:30</option>
                            <option value="23:00" >23:00</option>
                            <option value="23:30" >23:30</option>
                        </select>
                    </div>
                    <div class="col-xs-1 col-md-1 col-md-offset-1 col-lg-2 col-lg-offset-1">〜</div>
                    <div class="col-xs-2 col-md-1 col-lg-2">
                        <select>
                            <option value="00:00" >0:00</option>
                            <option value="00:30" >0:30</option>
                            <option value="01:00" >1:00</option>
                            <option value="01:30" >1:30</option>
                            <option value="02:00" >2:00</option>
                            <option value="02:30" >2:30</option>
                            <option value="03:00" >3:00</option>
                            <option value="03:30" >3:30</option>
                            <option value="04:00" >4:00</option>
                            <option value="04:30" >4:30</option>
                            <option value="05:00" >5:00</option>
                            <option value="05:30" >5:30</option>
                            <option value="06:00" >6:00</option>
                            <option value="06:30" >6:30</option>
                            <option value="07:00" >7:00</option>
                            <option value="07:30" >7:30</option>
                            <option value="08:00" >8:00</option>
                            <option value="08:30" >8:30</option>
                            <option value="09:00" >9:00</option>
                            <option value="09:30" >9:30</option>
                            <option value="10:00" >10:00</option>
                            <option value="10:30" >10:30</option>
                            <option value="11:00" >11:00</option>
                            <option value="11:30" >11:30</option>
                            <option value="12:00" >12:00</option>
                            <option value="12:30" >12:30</option>
                            <option value="13:00" >13:00</option>
                            <option value="13:30" >13:30</option>
                            <option value="14:00" >14:00</option>
                            <option value="14:30" >14:30</option>
                            <option value="15:00" >15:00</option>
                            <option value="15:30" >15:30</option>
                            <option value="16:00" >16:00</option>
                            <option value="16:30" >16:30</option>
                            <option value="17:00" >17:00</option>
                            <option value="17:30" >17:30</option>
                            <option value="18:00" >18:00</option>
                            <option value="18:30" >18:30</option>
                            <option value="19:00">19:00</option>
                            <option value="19:30" >19:30</option>
                            <option value="20:00" >20:00</option>
                            <option value="20:30" >20:30</option>
                            <option value="21:00" selected >21:00</option>
                            <option value="21:30" >21:30</option>
                            <option value="22:00" >22:00</option>
                            <option value="22:30" >22:30</option>
                            <option value="23:00" >23:00</option>
                            <option value="23:30" >23:30</option>
                        </select>
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
                    <label for="description">説明</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </span>
                        <input type="text" class="form-control" name="description" placeholder="説明"
                               value="{if isset($event_item.description)}{$event_item.description}{/if}" autocomplete="off" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>