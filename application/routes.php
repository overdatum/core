<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

if(Config::get('layla.url') == '(:url)')
{
	Route::get('(.*)', function()
	{
		Bundle::start('layla_thirdparty_bootsparks');
		return View::make('layouts.default')->with('meta_title', 'Install wizard')->nest('content', 'install.wizard');
	});

	Route::post('(.*)', function()
	{
		// Path to Layla config
		$layla_config_file = path('app').'config'.DS.'layla'.EXT;

		// Get contents of DB config file
		$layla_config = File::get($layla_config_file);

		// Apply the changes
		$layla_config = str_replace(
			array(
				'(:api.driver)',
				'(:api.url)',
				'(:url)',
				'(:start)',
			),
			array(
				'directly',
				'',
				'manage',
				"admin', 'domain",
			),
			$layla_config
		);

		// Save the changes
		File::put($layla_config_file, $layla_config);


		// Path to DB config file
		$database_config_file = path('app').DS.'config'.DS.'database'.EXT;

		// Get contents of DB config file
		$database_config = File::get($database_config_file);
		
		// Apply the changes
		$database_config = str_replace(
			array(
				'(:database_connection)',
				'(:database_user)',
				'(:database_password)',
				'(:database_name)',
			),
			array(
				Input::get('database_connection'),
				Input::get('database_user'),
				Input::get('database_password'),
				Input::get('database_name'),
			),
			$database_config
		);

		// Save the changes
		File::put($database_config_file, $database_config);

		// TODO: Add user via API
		// TODO: Install bundles

		return Redirect::to('/');
	});
}
else
{
	Route::get('/', function()
	{
		return View::make('layouts.default')->with('meta_title', 'A sexy CMS that knows what it wants')->nest('content', 'home.index');
	});
}

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});