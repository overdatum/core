<?php

/**
* 
*/
class Layla_Base_Controller extends Controller
{

	public $per_page = 10;

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
	 * Invoke layout method
	 * 
	 * @var bool
	 */
	public $layout = true;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->url = Config::get('layla::install.url').'/';
	}

	/**
	 * layout
	 * 
	 * @return View
	 */
	public function layout()
	{
		return View::make('layla_client::layouts.default')
				   ->with('meta_title', $this->meta_title);
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