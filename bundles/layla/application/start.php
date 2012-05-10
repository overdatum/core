<?php

// --------------------------------------------------------------
// Set Layla's paths
// --------------------------------------------------------------
$GLOBALS['laravel_paths']['layla_app'] = 'layĺa'.DS.'application'.DS;
$GLOBALS['laravel_paths']['layla_bundles'] = 'layla'.DS.'bundles'.DS;
$GLOBALS['laravel_paths']['layla_thirdparty'] = 'layla'.DS.'thirdparty'.DS;

// --------------------------------------------------------------
// Load helpers
// --------------------------------------------------------------
require __DIR__.DS.'helpers'.EXT;

// --------------------------------------------------------------
// Load bundles
// --------------------------------------------------------------
$bundles = require __DIR__ . DS . 'bundles'.EXT;
foreach ($bundles as $bundle => $config)
{
	Bundle::register($bundle, $config);
}

// --------------------------------------------------------------
// Start bundles
// --------------------------------------------------------------
foreach (Config::get('layla::install.start') as $bundle)
{
	Bundle::start('layla_' . $bundle);
}

// --------------------------------------------------------------
// Auth config
// --------------------------------------------------------------
Config::set('auth.driver', 'eloquent');
Config::set('auth.model', 'Account');