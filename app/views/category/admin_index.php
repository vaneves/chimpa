<form action="~/admin/category/remove" method="POST">
	<div class="alert alert-warning" id="category-remove-confirm" style="display: none;">
		<span>Tem certeza que deseja remover estas categorias?</span>
		<div class="btn-navbar pull-right">
			<input type="submit" class="btn btn-danger" value="Excluir" />
			<input type="button" data-toggle="dismiss" value="Cancelar" class="btn" />
		</div>
		<div class="clearfix"></div>
	</div>
	<h1>Categorias</h1>
	<div class="row-fluid">
		<table class="table table-striped">
			<caption>
				<div class="btn-navbar pull-left">
					<div class="btn-group">
						<a href="~/admin/category/add" class="btn btn-inverse"><i class="icon icon-plus icon-white"></i> Nova</a> 
					</div>
					<div class="btn-group">
						<a href="#category-remove-confirm" data-toggle="confirm" class="btn">Excluir</a>
					</div>
				</div>
			</caption>
			<thead>
				<tr>
					<th class="span1">&nbsp;</th>
					<th class="span5">Nome</th>
					<th class="span6">Slug</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($model->Data): ?>
					<?php foreach ($model->Data as $c): ?>
						<tr>
							<td><input type="checkbox" name="items[]" value="<?= $c->Id ?>" /></td>
							<td><a href="~/admin/category/edit/<?= $c->Id ?>"><?= $c->Name ?></a></td>
							<td><?= $c->Slug ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">Não há categorias a serem listadas.</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
		<?= Pagination::create('admin/category/index', $model->Count, $p, $m) ?>
	</div>
</form>
