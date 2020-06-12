{foreach $items as $item}
    {autoescape  true}
    <div class="card mb-3">
        <div class="card-header">
            <div class="float-right">
                {if $admin}
                <a href="/task/edit/{$item.id}">
                    <span class="btn btn-info">Edit</span>
                </a>
                {/if}
                {if $item.status == 2}
                    <span class="btn btn-danger">Выполнено</span>
                {/if}
                {if $item.status == 1}
                    <span class="btn btn-info">Updated</span>
                {/if}
            </div>
            <p>{$item.id}-<a href="/task/{$item.id}">{$item.username}</a></p>
            <p>{$item.email}</p>
        </div>
        <div class="card-body">
            <div class="card-text">

                {$item.tasktext|truncate:500:"..."}

            </div>
        </div>
    </div>
    {/autoescape}
{/foreach}