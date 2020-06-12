{extends '_base.tpl'}

{block 'title'}
    {$title} / {parent}
{/block}

{block 'content'}
    {insert 'addtaskform.tpl'}
    {if $items}
        <div class="row">
            <div class="col">

            </div>
        </div>
        {insert '_sorting.tpl'}

            <div>
                {insert '_tasks.tpl'}
            </div>
            <div class="tasks-pagination">
                {if $pagination}
                    {insert '_pagination.tpl'}
                {/if}
            </div>

    {else}
        <a href="/news/">&larr; Назад</a>
        {parent}
    {/if}
{/block}
