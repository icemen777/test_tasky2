{extends '_base.tpl'}

{block 'title'}
	{$title} / {parent}
{/block}

{block 'content'}
	{if $item}
		<div id="news-wrapper">
			<div class="card mb-2">
				<div class="card-header"><a href="/task/{$item.id}">{$item.username}</a></div>
				<div class="card-body">
					<div class="card-text">
						{autoescape  true}
						{$item.tasktext}
						{/autoescape}
					</div>
				</div>
			</div>
		</div>
	{/if}
{/block}