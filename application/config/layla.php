<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| API Settings
	|--------------------------------------------------------------------------
	| Layla will configure this file for you, just visit your homepage
	*/

	'start' => array('admin', 'domain', 'client'),

	'domain' => array(
		'api' => array(
			'version' => 1
		)
	),

	'admin' => array(
		'url_prefix' => 'manage',
		'api' => array(
			'url' => '',
			'driver' => 'directly',
			'version' => 1
		)
	),

	'client' => array(
		'api' => array(
			'url' => '',
			'driver' => 'directly',
			'version' => 1
		)
	),

);