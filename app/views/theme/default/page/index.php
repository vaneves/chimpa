<article class="row-fluid">
	<header>
		<h1><?= $model->Title ?></h1>
	</header>
	<hr />
	<?= $model->Content ?>
	
	<?php if(is_array($children)): ?>
	<ul class="nav nav-pills nav-stacked">
		<?php foreach ($children as $p): ?>
		<li><a href="~/<?= $p->Slug ?>"><?= $p->Title ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php endif ?>
</article>
