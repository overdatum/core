<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| API Settings
	|--------------------------------------------------------------------------
	| Layla will configure this file for you, just visit your homepage
	*/

	'start' => array('(:start)'),

	'domain' => array(
		'url_prefix' => 'api',
		'api' => array(
			'version' => 1
		)
	),

	'admin' => array(
		'url_prefix' => '(:admin.url_prefix)',
		'api' => array(
			'url' => '(:admin.api.url)',
			'driver' => '(:admin.api.driver)',
			'version' => 1,
			'username' => 'user',
			'password' => 'pass'
		)
	),

	'client' => array(
		'api' => array(
			'url' => '(:client.api.url)',
			'driver' => '(:client.api.driver)',
			'version' => 1,
			'username' => 'user',
			'password' => 'pass'
		)
	),

);