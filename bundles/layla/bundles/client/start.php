<?php
// --------------------------------------------------------------
// Map the Base Controller
// --------------------------------------------------------------
Autoloader::map(array(
	'Layla_Base_Controller' => __DIR__.DS.'controllers'.DS.'base'.EXT,
));

// --------------------------------------------------------------
// Load controllers
// --------------------------------------------------------------
Route::controller(array(
	'layla_client::account',
	'layla_client::media',
	'layla_client::page',
	'layla_client::auth',
));

// --------------------------------------------------------------
// Load namespaces
// --------------------------------------------------------------
Autoloader::namespaces(array(
	'Layla' => __DIR__.DS.'libraries'
));

// --------------------------------------------------------------
// Load bundles
// --------------------------------------------------------------
$bundles = require __DIR__ . DS . 'bundles'.EXT;
foreach ($bundles as $bundle => $config)
{
	Bundle::register($bundle, $config);
	if($config['auto'])
	{
		Bundle::start($bundle);
	}
}

// --------------------------------------------------------------
// Default Composer
// --------------------------------------------------------------
View::composer('layla_client::layouts.default', function($view)
{
	$view->shares('url', Config::get('layla::install.url').'/');

	Asset::container('header')->add('jquery', 'js/jquery.min.js')
		->add('bootstrap', 'css/bootstrap.min.css')
		->add('bootstrap-responsive', 'css/bootstrap-responsive.css')
		->add('main', 'css/main.css');
	
	Asset::container('footer')->add('bootstrap', 'js/bootstrap.js');
});

// --------------------------------------------------------------
// Set Aliases
// --------------------------------------------------------------
Autoloader::alias('Layla\\API', 'API');
Autoloader::alias('Layla\\Notification', 'Notification');
Autoloader::alias('Layla\\HTML', 'HTML');