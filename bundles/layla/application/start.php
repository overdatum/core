<?php

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
// Auth config
// --------------------------------------------------------------
Config::set('auth.driver', 'eloquent');
Config::set('auth.model', 'Account');