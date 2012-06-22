<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Layla - {{ $meta_title }}</title>
	<meta name="viewport" content="width=device-width">
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::style('bootstrap/css/bootstrap.css') }}
	{{ HTML::style('bootstrap/css/bootstrap-responsive.min.css') }}
	{{ HTML::style('css/main.css') }}
	{{ Asset::container('header')->scripts() }}
	{{ Asset::container('header')->styles() }}
	<style>
		h1 {
			font-size: 45px;
			line-height: 70px;
		}

		.center-content {
			text-align: center;
		}

		code {
			margin-top: 20px;
			line-height: 40px;
			display: inline-block;
			font-family: 'monospace';
			font-size: 28px;
			padding: 20px;
			background: #000;
			color: #fff;
			border: 2px solid #fff;
			box-shadow: 0px 0px 15px rgba(0, 0, 0, .4);
		}
	</style>
</head>
<body>
	{{ $content }}
	{{ Asset::container('footer')->scripts() }}
</body>
</html>
