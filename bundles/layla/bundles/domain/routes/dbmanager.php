<?php

Route::get('api/dbmanager/tables', function() {
	$response = DBManager::tables();
	return Response::json($response);
});

Route::get('api/dbmanager/table/(:any)', function($table) {
	$response = DBManager::table($table)->info();
	return Response::json($response);
});

Route::post('api/dbmanager/table', function() {
	$input = array(
		'posts' => array(
			'title' => array(
				'type' => 'string',
				'length' => 100,
			),
			'content' => array(
				'type' => 'text',
				'length' => 100,
			),
			'extra' => array(
				'type' => 'text',
				'length' => 100,
				'nullable' => true
			),
		),
		'post_lang' => array(
			'name' => array(
				'type' => 'string',
			),
			'locale' => array(
				'type' => 'string',
				'length' => 5,
			),
		),
	);
	// $response = DBManager::new_table($input);
	return Response::json($input);
});