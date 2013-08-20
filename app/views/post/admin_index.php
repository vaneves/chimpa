<div class="row-fluid">
	<form action="~/admin/post/remove" method="POST">
		<div class="alert alert-warning" id="post-remove-confirm" style="display: none;">
			<span>Tem certeza que deseja remover estas páginas?</span>
			<div class="btn-navbar pull-right">
				<input type="submit" class="btn btn-danger" value="Excluir" />
				<input type="button" data-toggle="dismiss" value="Cancelar" class="btn" />
			</div>
			<div class="clearfix"></div>
		</div>
		<h1>Páginas</h1>
		<table class="table table-striped">
			<caption>
				<div class="btn-group pull-right">
					<a href="~/admin/post/add" class="btn btn-inverse"><i class="icon icon-plus icon-white"></i> Novo</a>
					<a href="#post-remove-confirm" data-toggle="confirm" class="btn">Excluir</a>
				</div>
			</caption>
			<thead>
				<tr>
					<th class="span1">&nbsp;</th>
					<th class="span6">Título</th>
					<th class="span3">Autor</th>
					<th class="span2">Data</th>
				</tr>
			</thead>
			<tbody>
				<?php if($model->Data): ?>
					<?php foreach ($model->Data as $p): $p->humanize() ?>
						<tr>
							<td><input type="checkbox" name="items[]" value="<?= $p->Id ?>"></td>
							<td>
								<span class="badge <?= $p->Status ? 'badge-success' : '' ?>">&nbsp;</span>
								<a href="~/admin/post/edit/<?= $p->Id ?>"><?= $p->Title ?></a>
							</td>
							<td><?= $p->Author ?></td>
							<td><?= $p->PublicatedDate ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="4">Não há páginas a serem listadas.</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
		<?= Pagination::create('admin/page/index', $model->Count, $p, $m) ?>
	</form>
</div>
