<h1>Post <small><?= $label ?></small></h1>
<form method="post" action="">
	<?= BForm::input('Título', 'Title', $model->Title, 'input-block-level', array('placeholder' => 'Digite o título aqui')) ?>
	<?= BForm::textarea('Conteúdo', 'Content', $model->Content, 'input-block-level ckeditor') ?>
	<?php if($label == 'Criar' || $model->Status === 0): ?>
	<button type="submit" class="btn btn-inverse">Publicar</button>
	<button type="submit" class="btn" name="Draft" value="1">Salvar Rascunho</button>
	<?php else: ?>
	<button type="submit" class="btn btn-inverse">Atualizar</button>
	<?php endif ?>
	<a href="~/admin/post" class="help-inline">Voltar</a>
</form>