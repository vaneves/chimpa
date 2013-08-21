<div class="row-fluid">
	<h1>Procurando por "<?= $q ?>"</h1>
	<hr/>
</div>
<div class="row-fluid">
	<?php if ($model->Data): ?>
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
<?= Pagination::create('post/search', $model->Count, $p, $m) ?>