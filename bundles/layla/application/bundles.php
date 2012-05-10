<?php

return array(

	'layla_domain' => array(
		'auto' => true,
		'location' => 'layla'.DS.'bundles'.DS.'domain' 
	),

	'layla_client' => array(
		'auto' => true,
		'location' => 'layla'.DS.'bundles'.DS.'client',
		'handles' => Config::get('layla::install.url')
	),

);