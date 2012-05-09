<?php

// --------------------------------------------------------------
// Map the Base Controller
// --------------------------------------------------------------
Autoloader::map(array(
	'Layla_Base_Controller' => __DIR__.DS.'controllers'.DS.'base'.EXT,
));

// --------------------------------------------------------------
// Set Layla's paths
// --------------------------------------------------------------
$GLOBALS['laravel_paths']['layla_app'] = 'layĺa'.DS.'application'.DS;
$GLOBALS['laravel_paths']['layla_bundles'] = 'layla'.DS.'bundles'.DS;
$GLOBALS['laravel_paths']['layla_thirdparty'] = 'layla'.DS.'thirdparty'.DS;

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
// Authority Filter
// --------------------------------------------------------------
$login_url = Bundle::get('layla_client.handles') . '/auth/login';
Route::filter('authority', function($resource) use ($login_url)
{
	$action = Request::$route->parameters['0'];
	if(Authority::cannot($action, $resource))
	{
		return Redirect::to($login_url);
	}
});

// --------------------------------------------------------------
// Auth Filter
// --------------------------------------------------------------
Route::filter('auth', function() use ($login_url)
{
	if (Auth::guest()) return Redirect::to($login_url);
});