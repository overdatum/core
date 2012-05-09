<?php

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
// Load Routes
// --------------------------------------------------------------
require __DIR__.DS.'routes'.DS.'account'.EXT;
require __DIR__.DS.'routes'.DS.'media'.EXT;
require __DIR__.DS.'routes'.DS.'page'.EXT;
require __DIR__.DS.'routes'.DS.'dbmanager'.EXT;