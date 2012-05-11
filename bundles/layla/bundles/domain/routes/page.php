<?php
/*
|--------------------------------------------------------------------------
| Page API
|--------------------------------------------------------------------------
|
| 
|
*/

// --------------------------------------------------------------
// Get all pages
// --------------------------------------------------------------
Route::get('api/page/all', function() {
	// Overriding default options with the "user-set" ones
	$options = array_merge(array(
		'offset' => 0,
		'limit' => 20,
		'sort_by' => 'page.order',
		'order' => 'ASC'
	), Input::all());

	// Add tablename prefix to sort_by, if set
	if(Input::has('sort_by'))
	{
		$page_lang_columns = array('url', 'meta_title', 'meta_keywords', 'meta_description', 'menu', 'content');
		$options['sort_by'] = (in_array(Input::get('sort_by'), $page_lang_columns) ? 'page_lang' : 'pages').'.'.Input::get('sort_by');
	}

	// Preparing our query
	$pages = Page::with(array('account'))->join('page_lang', 'pages.id', '=', 'page_lang.page_id');

	// Add where's to our query
	if(array_key_exists('search', $options))
	{
		foreach($options['search']['columns'] as $column)
		{
			$pages = $pages->or_where($column, '~*', $options['search']['string']);
		}
	}

	$total = (int) $pages->count();

	// Add order_by, skip & take to our results query
	$pages = $pages->order_by($options['sort_by'], $options['order'])->skip($options['offset'])->take($options['limit'])->get();

	$response = array(
		'results' => to_array($pages),
		'total' => $total,
		'pages' => ceil($total / $options['limit'])
	);

	return Response::json($response);
});

// --------------------------------------------------------------
// Get page by id
// --------------------------------------------------------------
Route::get('api/page/(:num)', function($id) {
	//get page data blabla
	return Response::json($page);
});

// --------------------------------------------------------------
// New page
// --------------------------------------------------------------
Route::post('api/page', function() {
	return;
});

// --------------------------------------------------------------
// Edit page by id
// --------------------------------------------------------------
Route::put('api/page/(:num)', function($id) {
	return;
});