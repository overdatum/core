<?php

return array(

	'layla_api' => array(
		'auto' => true,
		'location' => 'layla'.DS.'bundles'.DS.'api' 
	),

	'layla_client' => array(
		'auto' => true,
		'location' => 'layla'.DS.'bundles'.DS.'client',
		'handles' => Config::get('layla::application.url')
	),

);