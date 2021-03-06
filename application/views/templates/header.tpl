<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" id="logo" href="{site_url}">調整くん</a>

            {if $is_login}
            <!--トグルボタン-->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-content">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {/if}
        </div>

        <div id="nav-content" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                {if $is_login}
                    <li><a href="{site_url}events"><span class="fa fa-home"></span>　ホーム</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-user"></span>　{$user_name}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            {if $admin}
                                <li><a href="{site_url}users"><span class="fa fa-users"></span>　メンバー管理</a></li>
                            {/if}
                            <li><a href="{site_url}users/edit/{$user_id}">
                                    <span class="fa fa-edit"></span>　編集</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{site_url}logout"><span class="fa fa-sign-out"></span>　ログアウト</a></li>
                        </ul>
                    </li>
                {/if}
            </ul>
        </div>
    </div>
</nav>