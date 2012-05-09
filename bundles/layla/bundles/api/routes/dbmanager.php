<?php

Route::get('api/dbmanager/tables', function() {
	$response = DBManager::tables();
	return Response::make(json_encode($response), 200, array('Content-Type' => 'application/json'));
});

Route::get('api/dbmanager/table/(:any)', function($table) {
	$response = DBManager::table($table)->info();
	return Response::make(json_encode($response), 200, array('Content-Type' => 'application/json'));
});