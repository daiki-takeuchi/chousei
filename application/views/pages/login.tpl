{extends file='templates/application.tpl'}
{block name=title}Login | 調整くん{/block}
{block name=main_contents}
    <div class="text-center">
        <img class="img-circle" src="{site_url}assets/images/avatar.png" width="180" height="180">
    </div>
    <p></p>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-default" >
                <div class="panel-body" >
                    <form method="post" action="{site_url}" accept-charset="utf-8">
                        {include file='pages/login_fields.tpl'}
                        <p><a href="#">ログインでお困りの場合はこちら</a></p>
                        <p><a href="{site_url}users/create">新規登録はこちら</a></p>
                        <div class="row">
                            <div class="col-sm-12 controls">
                                <button type="submit" name="submit" class="btn btn-primary pull-right"><span class="fa fa-sign-in"></span> ログイン</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}