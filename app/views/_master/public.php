<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= Config::get('charset') ?>">
		<meta charset="<?= Config::get('charset') ?>">
		<title><?= Config::get('site_name') ?></title>
		<link href="~/css/bootstrap.css" rel="stylesheet">
		<link href="~/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="~/css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="~/img/favicon.png">
	</head>
	<body>
		<?= Import::view(array(), 'home', 'navbar') ?>
		<div class="container-fluid content">
			<div class="row-fluid">
				<div class="span3">
					<?= Import::view(array('categories' => $categories), 'home', 'sidebar') ?>
				</div>
				<div class="span9">
					<?= CONTENT ?>
				</div>
			</div>
			<hr>
			<footer>
				<p>© <?= Config::get('site_name') ?> <?= date('Y') ?></p>
			</footer>
		</div>
		<script src="~/js/jquery.min.js"></script>
		<script src="~/js/bootstrap.min.js"></script>
	</body>
</html>