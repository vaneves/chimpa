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
		<table class="table table-striped table-bordered2">
			<caption>
				<div class="btn-group pull-right">
					<a href="~/admin/category/add" class="btn btn-inverse"><i class="icon icon-plus icon-white"></i> Nova</a>
					<a href="#category-remove-confirm" data-toggle="confirm" class="btn">Excluir</a>
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
				<?php if ($model->Count): ?>
					<?php foreach ($model->Data as $m): ?>
						<tr>
							<td><input type="checkbox" name="items[]" value="<?= $m->Id ?>" /></td>
							<td><a href="~/admin/category/edit/<?= $m->Id ?>"><?= $m->Name ?></a></td>
							<td><?= $m->Slug ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td>&nbsp;</td>
						<td colspan="2">Não existe nenhuma categoria.</td>
					</tr>
				<?php endif; ?>

			</tbody>
		</table>
	</div>
</form>
