<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= Config::get('charset') ?>">
		<meta charset="<?= Config::get('charset') ?>">
		<title><?= Config::get('site_name') ?></title>
		<link href="~/theme/default/css/bootstrap.min.css" rel="stylesheet">
		<link href="~/theme/default/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link rel="shortcut icon" href="~/img/favicon.png">
	</head>
	<body>
		<?= Import::view(array('pages' => $pages), 'home', 'navbar') ?>
		<div class="container-fluid content">
			<div class="row-fluid">
				<div class="span3">
					<?= Import::view(array('categories' => $categories), 'home', 'sidebar') ?>
				</div>
				<section class="span9">
					<?= CONTENT ?>
				</section>
			</div>
			<hr>
			<footer>
				<p class="muted"><?= Config::get('site_name') ?> - Feito com <a href="http://triladophp.org">Trilado Framework</a>.</p>
			</footer>
		</div>
	</body>
</html>