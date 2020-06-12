<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {block 'title'} Taskbook{/block}
    </title>
    {block 'css'}
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/bootstrap-grid.css">
        <link rel="stylesheet" href="/css/bootstrap-theme.css">
        <link rel="stylesheet" href="/css/glyf.css">
        <link rel="stylesheet" href="/css/main.css">
    {/block}
</head>
<body>
{block 'navbar'}
    {include '_navbar.tpl'}
{/block}
<div class="container">
    {if $message!=""}
        <div class="card">
    {$message}
        </div>
    {/if}
    <div class="row">
        {if $.block.sidebar}
            <div class="col-md-10">
                {block 'content'}
                    <h3>{$pagetitle}</h3>
                    {$content}
                {/block}
            </div>
            <div class="col-md-2">
                {block 'sidebar'}
                {/block}
            </div>
        {else}
            <div class="col-12">
                {block 'content'}
                    {$content}
                {/block}
            </div>
        {/if}
    </div>
</div>
</body>
<footer>
    {block 'js'}
        <script src="/js/jquery-2.1.4.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/main.js"></script>
    {/block}
</footer>
</html>