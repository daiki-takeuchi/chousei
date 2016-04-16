<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">{$title}</div>
            <div class="panel-body">
                <div class="from-group">
                    <label for="title">タイトル</label>
                    <div class='input-group'>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </span>
                        <input type="text" class="form-control" name="title" placeholder="タイトル"
                               value="{if isset($event_item.title)}{$event_item.title}{/if}" autocomplete="off" />
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