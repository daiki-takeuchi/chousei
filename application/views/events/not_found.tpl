{extends file='templates/application.tpl'}

{block name=title}
    {'Event Not Found'}
{/block}

{block name=main_contents}
    <div class="container not_found">
        <h1>Event Not Found</h1>
        <p>The event you requested was not found.</p>
    </div>
{/block}