<?php

use Laravel\CLI\Command;

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

$connection = true;
try {
	DB::query('SELECT * FROM laravel_migrations');
}
catch (Exception $e)
{
	$connection = false;
}

if( ! $connection)
{
	require path('sys').'cli/dependencies'.EXT;

	if( ! File::exists(path('app').'config'.DS.'layla'.EXT) || Config::get('layla.start.0') == '(:start)')
	{
		Route::get('(.*)', function()
		{
			return Redirect::to('install');
		});

		Route::get('install', function()
		{
			Asset::container('footer')->add('wizard_js', 'js/install/wizard.js');
			Asset::container('header')->add('wizard_css', 'css/install/wizard.css');
			
			$check_paths = array(
				path('bundle'),
				path('app').'config',
				path('storage').'cache',
				path('storage').'database',
				path('storage').'logs',
				path('storage').'sessions',
				path('storage').'views',
			);

			$writable = true;
			$paths = array();
			foreach ($check_paths as $path)
			{
				$is_writable = is_writable($path);
				$paths[$path] = $is_writable;

				if( ! $is_writable)
				{
					$writable = false;
				}
			}

			if($writable && ! is_dir(path('bundle').'components'))
			{
				ob_start();
					Command::run(array('bundle:install', 'components'));
				ob_end_clean();
				
				return Redirect::to('/');
			}

			Bundle::start('thirdparty_bootsparks');

			return View::make('layouts.default')->with('meta_title', 'Install wizard')
												->nest('content', 'install.wizard', array(
														'writable' => $writable,
														'paths' => $paths
													));
		});

		Route::post('install', function()
		{
			if( ! is_dir(path('bundle').'domain') && ! is_dir(path('bundle').'admin') && ! is_dir(path('bundle').'client'))
			{
				ob_start();
					if(Input::get('start_domain') == '1')
						Command::run(array('bundle:install', 'domain'));
					if(Input::get('start_admin') == '1')
						Command::run(array('bundle:install', 'admin'));
					if(Input::get('start_client') == '1')
						Command::run(array('bundle:install', 'client'));
				ob_end_clean();
			}

			// Get contents of DB config file
			$layla_config = File::get(path('app').'config'.DS.'layla.stub'.EXT);

			// Apply the changes
			$layla_config = str_replace(
				array(
					'(:admin.url_prefix)',
					'(:admin.api.url)',
					'(:admin.api.driver)',
					'(:client.api.url)',
					'(:client.api.driver)',
					'(:start)',
				),
				array(
					Input::get('url'),
					Input::get('admin_api_url'),
					Input::has('admin_api') ? 'json' : 'directly',
					Input::get('client_api_url'),
					Input::has('client_api') ? 'json' : 'directly',
					implode("', '", array('admin', 'domain', 'client'))
				),
				$layla_config
			);

			// Save the changes
			File::put(path('app').'config'.DS.'layla'.EXT, $layla_config);

			// Get contents of DB config file
			$database_config = File::get(path('app').DS.'config'.DS.'database.stub'.EXT);
			
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
			File::put(path('app').DS.'config'.DS.'database'.EXT, $database_config);

			ob_start();
				if(Input::get('start_domain') == '1')
				{
					Command::run(array('migrate:install'));
					Command::run(array('migrate'));
				}
			ob_end_clean();
			
			// TODO: Add user via API

			return Redirect::to('/');
		});
	}
	else
	{
		ob_start();
			Command::run(array('migrate:install'));
			Command::run(array('migrate'));
		ob_end_clean();

		return Redirect::to('/');
	}
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