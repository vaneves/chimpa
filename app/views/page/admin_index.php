<h1>Páginas</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Título</th>
			<th>Ordem</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if($model->Data): ?>
			<?php foreach($model->Data as $p): ?>
			<tr>
				<td>
					<a href="~/admin/page/edit/<?= $p->Id ?>"><?= $p->Title ?></a>
				</td>
				<td><?= $p->Order ?></td>
				<td><?= $p->Status ?></td>
			</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="3">Nenhuma página para ser listada.</td>
			</tr>
		<?php endif ?>
	</tbody>
</table>
<div class="pagination">
	<ul>
		<li><a href="#">&laquo;</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">&raquo;</a></li>
	</ul>
</div>