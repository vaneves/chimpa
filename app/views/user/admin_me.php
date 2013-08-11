<div class="row-fluid">
	<h1>Editar Perfil</h1>
	<div class="container-fluid">
		<form id="profile-form" class="form-horizontal" method="POST" action="">
			<div class="control-group">
				<label for="Name" class="control-label">Nome</label>
				<div class="controls">
					<input id="Name" class="span9" name="Name" type="text" value="<?= $model->Name ?>" />
				</div>
			</div>
			<div class="control-group">
				<label for="Email" class="control-label">E-mail</label>
				<div class="controls">
					<input id="Email" class="span9" name="Email" type="text" value="<?= $model->Email ?>" />
				</div>
			</div>
			<div class="control-group">
				<label for="Password" class="control-label">Nova Senha</label>
				<div class="controls">
					<input id="Password" name="Password" type="password" value="" />
					<input id="Repassword" name="Repassword" type="password" placeholder="Repita a senha" value="" style="display: none;" />
				</div>
			</div>
			<div id="OldPassword-group" class="control-group" style="display: none;">
				<label for="OldPassword" class="control-label">Senha Antiga</label>
				<div class="controls">
					<input id="OldPassword" name="OldPassword" type="password" value="" />
				</div>
			</div>
			<div class="form-actions">
				<input type="submit" value="Salvar" class="btn btn-inverse" />
				<a href="~/admin/" class="help-inline">Voltar</a>
			</div>
		</form>
	</div>
</div>