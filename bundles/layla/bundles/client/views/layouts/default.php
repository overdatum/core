<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $meta_title ?> | Layla</title>
	<?= Asset::container('header')->styles(); ?>
	<?= Asset::container('header')->scripts(); ?>
</head>
<body>
<div id="main">
	<?= $content ?>
</div>
<?= Asset::container('footer')->scripts(); ?>
</body>
</html>