<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= Config::get('charset') ?>">
		<meta charset="<?= Config::get('charset') ?>">
		<title><?= Config::get('site_name') ?></title>
		<link href="~/theme/default/css/bootstrap.min.css" rel="stylesheet">
		<!--<link href="~/theme/default/css/bootstrap-responsive.min.css" rel="stylesheet">-->
		<link rel="shortcut icon" href="~/img/favicon.png">
	</head>
	<body>
		<header class="container">
			<div class="row-fluid">
				<div class="span12">
					<h1 class="muted">Chimpan</h1>
				</div>
			</div>
			<div class="navbar navbar-inverse">
				<nav class="navbar-inner">
					<ul class="nav">
						<li><a href="~/">Início</a></li>
						<?php foreach ($pages as $p): ?>
						<li><a href="~/<?= $p->Slug ?>"><?= $p->Title ?></a></li>
						<?php endforeach; ?>
					</ul>
					<form class="navbar-form pull-right" action="~/post/search" method="GET">
						<input type="text" name="q" class="search-query span2" placeholder="Busca">
					</form>
				</nav>
			</div>
		</header>
		<div class="container">
			<div class="row-fluid">
				<section class="span8">
					<?= CONTENT ?>
				</section>
				<aside class="span4">
					<div class="sidebar-nav">
						<ul class="nav nav-list">
							<li class="nav-header">Categorias</li>
							<?php foreach ($categories as $c): ?>
								<li><a href="~/category/<?= $c->Slug ?>"><?= $c->Name ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</aside>
			</div>
			<hr>
			<footer>
				<p class="muted"><?= Config::get('site_name') ?> - Feito com <a href="http://triladophp.org">Trilado Framework</a>.</p>
			</footer>
		</div>
	</body>
</html>