<h1>Página <small><?= $label ?></small></h1>
<form method="post" action="">
	<?= BForm::input('Título', 'Title', $model->Title, 'input-block-level', array('placeholder' => 'Digite o título aqui')) ?>
	<?= BForm::textarea('Conteúdo', 'Content', $model->Content, 'input-block-level ckeditor') ?>
	<?php if($label == 'Criar'): ?>
	<button type="submit" class="btn btn-inverse">Publicar</button>
	<button type="submit" class="btn" name="Drafit" value="1">Salvar Rascunho</button>
	<?php else: ?>
	<button type="submit" class="btn btn-inverse">Atualizar</button>
	<?php endif ?>
	<a href="~/admin/page" class="btn">Cancelar</a>
</form>