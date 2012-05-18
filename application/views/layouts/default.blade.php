<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Layla - {{ $meta_title }}</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/bootstrap-responsive.min.css') }}
	<style>
		.center-content {
			text-align: center;
		}
	</style>
</head>
<body>
	{{ $content }}
</body>
</html>
