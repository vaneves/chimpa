<header class="navbar navbar-inverse">
	<div class="navbar-inner">
		<nav class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="~/"><?= Config::get('site_name') ?></a>
			<div class="nav-collapse collapse navbar-inverse-collapse">
				<ul class="nav">
					<li><a href="~/">Início</a></li>
					<?php foreach ($pages as $p): ?>
					<li><a href="~/<?= $p->Slug ?>"><?= $p->Title ?></a></li>
					<?php endforeach; ?>
				</ul>
				<form class="navbar-form pull-right" action="~/post/search" method="GET">
					<input type="text" name="q" class="search-query span2" placeholder="Busca">
				</form>
			</div>
		</nav>
	</div>
</header>