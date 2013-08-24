<div class="sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">Categorias</li>
		<?php foreach ($categories as $c): ?>
			<li><a href="~/category/<?= $c->Slug ?>"><?= $c->Name ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>