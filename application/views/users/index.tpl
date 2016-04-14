{extends file='templates/application.tpl'}

{block name=title}{$title}{/block}

{block name=main_contents}
    <div class="row">
        <div class="col-md-12">
            <div class="list-group">
                {foreach from=$users item=users_item}
                    <li class="list-group-item">
                        <p>
                            <span class="created_at">{date('Y/m/d', strtotime($users_item['created_at']))}</span>
                        </p>
                        <a class="list-group-item-heading" href="{site_url}users/edit/{$users_item['id']}">
                            {$users_item['name']|escape}
                        </a>

                        <p class="list-group-item-text">
                            {$users_item['email']|escape}
                        </li>
                    </a>
                {/foreach}
            </div>
            {$pagination}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{site_url}users/create">登録</a>
        </div>
    </div>
{/block}