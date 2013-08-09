<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Orango</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Vaneves">

		<link href="~/css/bootstrap.css" rel="stylesheet">
		<link href="~/css/style.css" rel="stylesheet">
	</head>

	<body>
		<header>
			<div class="container">
				<div class="row-fluid">
					<div class="span5">
						<div class="logo"><h1 class="muted">Orango</h1></div>
					</div>
				</div>
			</div>
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="nav-collapse collapse">
							<?php if (Auth::isLogged()): ?>
								<ul class="nav">
									<li><a href="/ticket/add">Criar Ticket</a></li>
								</ul>
								<ul class="nav pull-right">
									<li><a href="/logout">Sair</a></li>
								</ul>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="container">
			<div class="row-fluid">
				<?= CONTENT ?>
			</div>
			<hr>
			<div class="footer">
				<p>&copy; Van Neves 2013 - <?= date('Y') ?></p>
			</div>
		</div>
		<script src="~/js/script.js"></script>
	</body>
</html>