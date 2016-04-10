{extends file='templates/application.tpl'}
{block name=title}Login | 調整くん{/block}
{block name=main_contents}
    <div class="text-center">
        <img class="img-circle" src="{site_url}assets/images/avatar.png" width="180" height="180">
    </div>
    <p></p>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default" >

                <div class="panel-body" >
                    <form method="post" action="{site_url}pages/login" accept-charset="utf-8">
                        {include file='pages/login_fields.tpl'}
                        <a href="#">ログインでお困りの場合はこちら</a>
                        <div class="row">
                            <div class="col-sm-12 controls">
                                <button type="submit" name="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-log-in"></span> ログイン</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}