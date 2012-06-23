<?php

return array(

	'module' => array(
		array(
			'read_multiple',
			'create',
			'read',
			'update',
			'delete'
		),
		array()
	),
	
	'account' => array(
		array(
			'read_multiple',
			'create',
			'read',
			'update',
			'delete'
		),
		array()
	),

	'page' => array(
		array(
			'read_multiple',
			'create',
			'read',
			'update',
			'delete'
		),
		array()
	),

	'language' => array(
		array(
			'read_multiple',
			'create',
			'read',
			'update',
			'delete'
		),
		array()
	),

	'role' => array(
		array(
			'read_multiple',
			'create',
			'read',
			'update',
			'delete'
		),
		array()
	),

	'layout' => array(
		array(
			'read_multiple',
			'create',
			'read',
			'update',
			'delete'
		),
		array()
	),

	'media' => array(
		array(
			'read_multiple'
		),
		array(
			'group' => array(
				array(
					'read_multiple',
					'create',
					'read',
					'update',
					'delete'
				),
				array(
					'asset' => array(
						array(
							'read_multiple',
							'create',
							'read',
							'update',
							'delete'
						),
						array()
					)
				)
			)
		)
	)

);