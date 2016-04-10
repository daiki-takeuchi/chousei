<div class="row">
    <div class="col-sm-12 controls">
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <div class='input-group'>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-envelope"></span>
                </span>
                <input type="text" class="form-control" name="email" placeholder="ログインメールアドレス"
                       value="{if isset($post['email'])}{$post['email']}{/if}" />
            </div>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <div class='input-group'>
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-lock"></span>
                </span>
                <input type="password" class="form-control" name="password" placeholder="パスワード" />
            </div>
        </div>
    </div>
</div>
