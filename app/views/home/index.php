<?php if($post): ?>
<div class="hero-unit">
	<h1><?= $post->Title ?></h1>
	<p><?= $post->Summary ?></p>
	<p><a href="~/<?= $post->Slug ?>" class="btn btn-primary btn-large">Ver mais »</a></p>
</div>
<?php endif; ?>
<div class="row-fluid">
	<?php if($model->Data): ?>
	<?php foreach ($model->Data as $p): $p->humanize() ?>
		<div class="span4">
			<h2><?= $p->Title ?></h2>
			<p><?= $p->Summary ?></p>
			<p><a class="btn" href="~/<?= $p->Slug ?>">Ver mais »</a></p>
		</div>
	<?php endforeach; ?>
	<?php else: ?>
		<div class="span12">
			<p>Nenhum post econtrado.</p>
		</div>
	<?php endif; ?>
</div>
<?= Pagination::create('home/index', $model->Count, $p, $m) ?>