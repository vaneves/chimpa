<form method="post" action="" class="form-signin">
	<?= FLASH ?>
	<div class="control-group">
		<label class="control-label" for="Email">E-mail</label>
		<div class="controls">
			<input name="Email" id="Email" value="<?= Request::post('Email') ?>" type="text" class="input-block-level">
		</div>
	</div>				
	<div class="control-group">
		<label class="control-label" for="Password">Senha</label>
		<div class="controls">
			<input name="Password" id="Password" type="password" class="input-block-level">
		</div>
	</div>
	<button type="submit" class="btn btn-inverse">Entrar</button>
</form>