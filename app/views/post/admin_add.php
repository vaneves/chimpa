<div class="span3">
	<ul class="nav nav-tabs nav-stacked">
		<li class="active"><a href="#">Posts</a></li>
		<li><a href="#">Categorias</a></li>
		<li><a href="#">Páginas</a></li>
		<li><a href="#">Usuários</a></li>
	</ul>
</div>
<div class="span9">
	<?= FLASH ?>
	<form method="post" action="">
		<div class="control-group">
			<label class="control-label" for="Email">Título</label>
			<div class="controls">
				<input name="Email" id="Email" value="<?= Request::post('Email') ?>" type="text" class="input-block-level">
			</div>
		</div>				
		<div class="control-group">
			<label class="control-label" for="Password">Senha</label>
			<div class="controls">
				<textarea name="Password" id="Password" type="password" class="input-block-level"></textarea>
			</div>
		</div>
		<button type="submit" class="btn btn-inverse">Entrar</button>
	</form>
</div>