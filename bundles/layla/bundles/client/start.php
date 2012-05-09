<?php

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