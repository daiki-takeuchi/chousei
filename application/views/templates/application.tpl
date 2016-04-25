<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <title>{block name=title}{/block}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" href="{site_url}assets/stylesheets/jquery-ui-1.11.4.custom.css"/>
    <link rel="stylesheet" href="{site_url}assets/stylesheets/bootstrap.min.css"/>
    <link rel="stylesheet" href="{site_url}assets/stylesheets/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{site_url}assets/stylesheets/bootstrap-clockpicker.min.css" />
    <link rel="stylesheet" href="{site_url}assets/stylesheets/font-awesome.min.css" />
    <link rel="stylesheet" href="{site_url}assets/stylesheets/application.css"/>
    <script src="{site_url}assets/javascripts/jquery-1.11.3.js"></script>
    <script src="{site_url}assets/javascripts/jquery-ui-1.11.4.custom.js"></script>
    <script src="{site_url}assets/javascripts/bootstrap.min.js"></script>
    <script src="{site_url}assets/javascripts/bootstrap-datepicker.min.js"></script>
    <script src="{site_url}assets/javascripts/bootstrap-datepicker.ja.min.js"></script>
    <script src="{site_url}assets/javascripts/bootstrap-clockpicker.min.js"></script>
    <script src="{site_url}assets/javascripts/bootbox.min.js"></script>
    <script src="{site_url}assets/javascripts/application.js"></script>
    {include file='templates/shim.tpl'}
</head>
<body>
{include file='templates/header.tpl'}
{block name=carousel}{/block}
{block name=jumbotron}{/block}
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {include file='templates/error_messages.tpl'}
        </div>
    </div>
    {block name=main_contents}{/block}
</div>
{include file='templates/footer.tpl'}
</body>
</html>