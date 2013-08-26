<form method="post" action="" class="form-install">
	<?= FLASH ?>
	<p>Indique os dados de conexão à sua base de dados. Se não tem a certeza, fale com o seu serviço de alojamento.</p>
	<?= BForm::input('Servidor', 'host', Request::post('host')) ?>
	<?= BForm::input('Usuário', 'user', Request::post('user')) ?>
	<?= BForm::input('Senha', 'pass', Request::post('pass')) ?>
	<?= BForm::input('Banco de Dados', 'name', Request::post('name')) ?>
	<button type="submit" class="btn">Enviar</button>
</form>