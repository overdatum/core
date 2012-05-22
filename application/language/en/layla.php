<?php 

return array(

	'install' => array(
		'title' => 'Layla install wizard',
		'sections' => array(
			'unwritable_paths_found' => 'Unwritable files / folders were found!',
			'general' => 'General settings',
			'account' => 'Admin account',
			'database' => 'Database configuration'
		),
		'install_type' => array(
			'common' => 'Common',
			'custom' => 'Custom'
		),
		'general' => array(
			'url' => 'Admin URL'
		),
		'account' => array(
			'email' => 'E-mail address',
			'password' => 'Password'
		),
		'database' => array(
			'connection' => 'Connection',
			'user' => 'Username',
			'password' => 'Password',
			'name' => 'Database name'
		)
	)

);