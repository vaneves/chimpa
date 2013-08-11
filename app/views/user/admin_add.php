<div class="row-fluid">
	<h1>Usuários <small><?= $label ?></small> </h1>
	<div class="container-fluid">
		<form id="user-form" class="form-horizontal" method="POST" action="">
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
				<label for="Password" class="control-label">Senha</label>
				<div class="controls">
					<input id="Password" name="Password" type="password" value="" />
				</div>
			</div>
			<div class="form-actions">
				<input type="submit" value="<?= $label ?>" class="btn btn-inverse" />
				<a href="~/admin/user" class="help-inline">Voltar</a>
			</div>
		</form>
	</div>
</div>