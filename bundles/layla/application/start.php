<?php

Autoloader::map(array(
	'Layla_Base_Controller' => __DIR__.'controllers'.DS.'base'.EXT,
));

Bundle::register('layla_api', array(
	'location' => __DIR__.DS.'..'.DS.'bundles'.DS.'api' 
));
Bundle::start('layla_api');

Bundle::register('layla_client', array(
	'location' => __DIR__.DS.'..'.DS.'bundles'.DS.'api' 
));
Bundle::start('layla_client');