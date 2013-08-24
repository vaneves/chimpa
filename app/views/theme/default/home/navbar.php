<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="~/"><?= Config::get('site_name') ?></a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li class="active"><a href="~/">Início</a></li>
					<?php foreach ($pages as $p): ?>
					<li><a href="~/<?= $p->Slug ?>"><?= $p->Title ?></a></li>
					<?php endforeach; ?>
				</ul>
				<div class="nav pull-right">
					<form id="form-query" action="~/post/search" method="GET">
						<div class="btn-group">
							<div class="input-append">
								<input id="input-search" type="text" name="q" value="">
								<a id="btn-search" href="javascript:void(0);" class="btn" type="button"><i class="icon icon-search"></i></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>