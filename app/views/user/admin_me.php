<div class="row-fluid">
	<h1>Editar Perfil</h1>
	<div class="container-fluid">
		<form id="profile-form" class="form-vertical" method="POST" action="">
			<div class="row-fluid">
				<div class="control-group span6">
					<label for="Name" class="control-label">Nome</label>
					<div class="controls">
						<input id="Name" class="span12" name="Name" type="text" value="<?= $model->Name ?>" />
					</div>
				</div>
				<div class="control-group span6">
					<label for="Email" class="control-label">E-mail</label>
					<div class="controls">
						<input id="Email" class="span12" name="Email" type="text" value="<?= $model->Email ?>" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="Password" class="control-label">Nova Senha</label>
					<div class="controls">
						<input id="Password" class="span12" name="Password" type="password" value="" />
					</div>
				</div>
				<div id="Repassword-group" class="control-group span4" style="display: none;">
					<label for="Password" class="control-label">Repita a Senha</label>
					<div class="controls">
						<input id="Repassword" class="span12" name="Repassword" type="password" value="" />
					</div>
				</div>
				<div id="OldPassword-group" class="control-group span4" style="display: none;">
					<label for="OldPassword" class="control-label">Senha Antiga</label>
					<div class="controls">
						<input id="OldPassword" class="span12" name="OldPassword" type="password" value="" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<input type="submit" value="Salvar" class="btn btn-inverse" />
				<a href="~/admin/" class="help-inline">Voltar</a>
			</div>
		</form>
	</div>
</div>