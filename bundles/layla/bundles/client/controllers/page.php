<?php

/**
* 
*/
class Layla_Client_Page_Controller extends Layla_Base_Controller
{
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function get_index()
	{
		// Set API options
		$options = array(
			'offset' => (Input::get('page', 1) - 1) * $this->per_page,
			'limit' => $this->per_page,
			'sort_by' => Input::get('sort_by', 'meta_title'),
			'order' => Input::get('order', 'ASC')
		);

		// Add search to API options
		if(Input::has('q'))
		{
			$options['search'] = array(
				'string' => Input::get('q'),
				'columns' => array(
					'menu', 
					'meta_title',
					'content'
				)
			);
		}

		// Get the Pages
		$pages = API::get(array('page', 'all'), $options)->get();

		// Paginate the Pages
		$pages = Paginator::make($pages->results, $pages->total, $this->per_page);

		$this->layout->content = View::make('layla_client::pages.index')->with('pages', $pages);
	}

	public function get_add()
	{
		// Get Languages
		$languages = model_array_pluck(API::get(array('language', 'all'))->get()->results, function($language) {
			return $language->name;
		}, 'id');

		// Get Layouts and put it in a nice array for the dropdown
		$layouts = model_array_pluck(API::get(array('layout', 'all'))->get()->results, function($layout) {
			return $layout->name;
		}, 'id');

		$this->layout->content = View::make('layla_client::page.add')
									 ->with('languages', $languages)
									 ->with('layouts', $layouts);
	}

	public function post_add()
	{
		$response = API::post(array('page'), Input::all());
		// Error were found our data! Redirect to form with errors and old input
		if($response->error())
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to($this->url.'page/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input();
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully created page');

		return Redirect::to($this->url.'page');
	}

	public function get_edit($id = null)
	{
		// Get the Account
		$response = API::get(array('page', $id));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// The response body is the Account
		$account = $response->get();

		$this->layout->content = View::make('layla_client::page.edit')
									 ->with('page', $page);
	}

	public function put_edit($id = null)
	{
		// Update the Account
		$response = API::put(array('page', $id), Input::all());

		// Handle response codes other than 200 OK
		if($response->error())
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to($this->url.'page/edit/' . $id)
							 ->with('errors', new Messages($response->get()))
					   ->with_input();
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated page');

		return Redirect::to($this->url.'page');
	}

	public function get_delete($id = null)
	{
		// Get the Account
		$response = API::get(array('page', $id));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// The request body is the Account
		$page = $response->get();

		$this->layout->content = View::make('layla_client::page.delete')
									 ->with('page', $page);
	}

	public function delete_delete($id = null)
	{
		// Delete the Account
		$response = API::delete(array('page', $id));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully deleted page');

		return Redirect::to($this->url.'page');
	}

}