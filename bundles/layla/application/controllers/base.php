<?php

/**
* 
*/
class Layla_Base_Controller extends Controller
{
	/**
	 * Website data
	 *
	 * @var array
	 **/
	public $data = array();

	/**
	 * Enable restful routing
	 *
	 * @var bool
	 **/
	public $restful = true;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}