<?php

use Laravel\Messages;

/**
* 
*/
class Layla_Client_Account_Controller extends Layla_Base_Controller
{

	public $per_page = 10;

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
	 * Account overview
	 */
	public function get_index()
	{
		// Set API options
		$options = array(
			'offset' => (Input::get('page', 1) - 1) * $this->per_page,
			'limit' => $this->per_page,
			'sort_by' => Input::get('sort_by', 'name'),
			'order' => Input::get('order', 'ASC')
		);

		// Add search to API options
		if(Input::has('q'))
		{
			$options['search'] = array(
				'string' => Input::get('q'),
				'columns' => array(
					'name', 
					'email'
				)
			);
		}

		// Get the Accounts
		$accounts = API::get(array('account', 'all'), $options)->get();

		// Paginate the Accounts
		$accounts = Paginator::make($accounts->results, $accounts->total, $this->per_page);

		$this->layout->content = View::make('layla_client::accounts.index')->with('accounts', $accounts);
	}

	public function get_add()
	{
		// Get Roles and put it in a nice array for the dropdown
		$roles = array('' => '') + model_array_pluck(API::get(array('role', 'all'))->get()->results, function($role) { 
			return $role->lang->name;
		}, 'id');

		// Get Languages and put it in a nice array for the dropdown
		$languages = model_array_pluck(API::get(array('language', 'all'))->get()->results, function($language) {
			return $language->name;
		}, 'id');

		$this->layout->content = View::make('layla_client::accounts.add')
									 ->with('roles', $roles)
									 ->with('languages', $languages);
	}

	public function post_add()
	{
		$response = API::post(array('account'), Input::all());
		// Error were found our data! Redirect to form with errors and old input
		if($response->error())
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to($this->url.'account/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully created account');

		return Redirect::to($this->url.'account');
	}

	public function get_edit($id = null)
	{
		// Get the Account
		$response = API::get(array('account', $id));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// The response body is the Account
		$account = $response->get();

		// Get Roles and put it in a nice array for the dropdown
		$roles = array('' => '') + model_array_pluck(API::get(array('role', 'all'))->get()->results, function($role) {
			return $role->lang->name;
		}, 'id');

		// Get the Roles that belong to a User and put it in a nice array for the dropdown
		$active_roles = array();
		if(isset($account->roles))
		{ 
			$active_roles = model_array_pluck($account->roles, 'id', '');
		}

		// Get Languages and put it in a nice array for the dropdown
		$languages = model_array_pluck(API::get(array('language', 'all'))->get()->results, function($language) {
			return $language->name;
		}, 'id');

		$this->layout->content = View::make('layla_client::accounts.edit')
									 ->with('account', $account)
									 ->with('roles', $roles)
									 ->with('active_roles', $active_roles)
 									 ->with('languages', $languages);
	}

	public function put_edit($id = null)
	{
		// Update the Account
		$response = API::put(array('account', $id), Input::all());

		// Handle response codes other than 200 OK
		if($response->error())
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to($this->url.'account/edit/' . $id)
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated account');

		return Redirect::to($this->url.'account');
	}

	public function get_delete($id = null)
	{
		// Get the Account
		$response = API::get(array('account', $id));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// The request body is the Account
		$account = $response->get();

		$this->layout->content = View::make('layla_client::accounts.delete')
									 ->with('account', $account);
	}

	public function put_delete($id = null)
	{
		// Delete the Account
		$response = API::delete(array('account', $id));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully deleted account');

		return Redirect::to($this->url.'account');
	}

}