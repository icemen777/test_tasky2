<div>
<nav>
	<ul class="pagination justify-content-center">
		{foreach $pagination as $page => $type}
			{switch $type}
			{case 'first'}
				<li class="page-item"><a href="/{$urlname}{$urlline}" class="page-link">&laquo;</a></li>
			{case 'last'}
				<li ><a href="/{$urlname}?page={$page}{$urlline}" class="page-link">&raquo;</a></li>
			{case 'less', 'more'}
			{case 'current'}
				<li class="page-item active"><a href="/{$urlname}?page={$page}{$urlline}" class="page-link">{$page}</a></li>
			{case default}
				<li class="page-item"><a href="/{$urlname}?page={$page}{$urlline}" class="page-link">{$page}</a></li>
			{/switch}
		{/foreach}
	</ul>
</nav>
</div>