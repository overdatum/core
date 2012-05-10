<?php namespace Layla\API\Drivers;

use Exception;

use Layla\APIResponse;

use Laravel\Input;
use Laravel\Request;
use Laravel\Routing\Route;

class Directly extends Driver {

	public static function call($method, $arguments, $input = array(), $segments = array())
	{
		Request::foundation()->query->replace($segments);

		$method = strtoupper($method);
		if(in_array($method, array('GET', 'DELETE')))
		{
 			Input::replace($input);
		}

		$uri = 'api/' . implode('/', $arguments);

		$response = Route::forward($method, $uri);

		$code = $response->foundation->getStatusCode();
		$content = '';
		if(in_array($code, array(200, 400)))
		{
			$content = $response->content;
		}
		
		return new APIResponse($code, json_decode($content));
	}

}