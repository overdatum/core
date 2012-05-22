<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| API Settings
	|--------------------------------------------------------------------------
	| Layla will configure this file for you, just visit your homepage
	*/

	'start' => array('admin', 'domain', 'client'),

	'admin' => array(
		'url_prefix' => 'manage',
		'api' => array(
			'url' => '',
			'driver' => 'directly'
		)
	),

	'client' => array(
		'api' => array(
			'url' => '',
			'driver' => 'directly'
		)
	),

);