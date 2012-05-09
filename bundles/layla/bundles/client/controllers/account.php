<?php

/**
* 
*/
class Layla_Client_Account_Controller extends Layla_Base_Controller
{

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->filter('before', 'authority:account');
		$this->filter('before', 'auth');
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

		$this->layout->content = View::make('layla_client_account::backend.accounts.index')->with('accounts', $accounts);
	}

	public function get_add()
	{
		if(Authority::cannot('create', 'Account'))
		{
			return Redirect::to('backend/accounts');
		}

		// Get Roles and put it in a nice array for the dropdown
		$roles = array('' => '') + model_array_pluck(API::get(array('role', 'all'))->get()->results, function($role) { 
			return $role->lang->name;
		}, 'uuid');

		// Get Languages and put it in a nice array for the dropdown
		$languages = model_array_pluck(API::get(array('language', 'all'))->get()->results, function($language) {
			return $language->name;
		}, 'uuid');

		$this->layout->content = View::make('layla_client_account::backend.accounts.add')
									 ->with('roles', $roles)
									 ->with('languages', $languages);
	}

	public function post_add()
	{
		if(Authority::cannot('create', 'Account'))
		{
			return Redirect::to('backend/accounts');
		}

		$response = API::post(array('account'), Input::all());
		// Error were found our data! Redirect to form with errors and old input
		if($response->error())
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to('backend/accounts/add')
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully created account');

		return Redirect::to('backend/accounts');
	}

	public function get_edit($uuid = null)
	{
		if(Authority::cannot('update', 'Account', $uuid))
		{
			return Redirect::to('backend/accounts');
		}

		// Get the Account
		$response = API::get(array('account', $uuid));

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
		}, 'uuid');

		// Get the Roles that belong to a User and put it in a nice array for the dropdown
		$active_roles = array();
		if(isset($account->roles))
		{ 
			$active_roles = model_array_pluck($account->roles, 'uuid', '');
		}

		// Get Languages and put it in a nice array for the dropdown
		$languages = model_array_pluck(API::get(array('language', 'all'))->get()->results, function($language) {
			return $language->name;
		}, 'uuid');

		$this->layout->content = View::make('layla_client_account::backend.accounts.edit')
									 ->with('account', $account)
									 ->with('roles', $roles)
									 ->with('active_roles', $active_roles)
 									 ->with('languages', $languages);
	}

	public function put_edit($uuid = null)
	{
		if(Authority::cannot('update', 'Account', $uuid))
		{
			return Redirect::to('backend/accounts');
		}

		// Update the Account
		$response = API::put(array('account', $uuid), Input::all());

		// Handle response codes other than 200 OK
		if($response->error())
		{
			// Errors were found on our data! Redirect to form with errors and old input
			if($response->code == 400)
			{
				return Redirect::to('backend/accounts/edit/' . $uuid)
							 ->with('errors', new Messages($response->get()))
					   ->with_input('except', array('password'));
			}

			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully updated account');

		return Redirect::to('backend/accounts');
	}

	public function get_delete($uuid = null)
	{
		if(Authority::cannot('delete', 'Account', $uuid))
		{
			return Redirect::to('backend/accounts');
		}

		// Get the Account
		$response = API::get(array('account', $uuid));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// The request body is the Account
		$account = $response->get();

		$this->layout->content = View::make('layla_client_account::backend.accounts.delete')
									 ->with('account', $account);
	}

	public function put_delete($uuid = null)
	{
		if(Authority::cannot('delete', 'Account', $uuid))
		{
			return Redirect::to('backend/accounts');
		}

		// Delete the Account
		$response = API::delete(array('account', $uuid));

		// Handle response codes other than 200 OK
		if($response->error())
		{
			return Event::first($response->code);
		}

		// Add success notification
		Notification::success('Successfully deleted account');

		return Redirect::to('backend/accounts');
	}

}