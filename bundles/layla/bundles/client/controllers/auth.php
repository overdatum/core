<?php

use Laravel\Messages;

class Layla_Client_Auth_Controller extends Layla_Base_Controller {

	public $meta_title = 'Authentication';

	public function get_login()
	{
		$this->layout->content = View::make('layla_client::auth.login');
	}

	public function put_login()
	{
		$auth = API::post(array('auth', 'login'), Input::all());
		if($auth->code == 400)
		{
			return Redirect::to($this->url.'auth/login')->with('errors', new Messages($auth->get()))->with_input('except', array());
		}
	}

	public function get_logout()
	{
		Auth::logout();

		return Redirect::to($this->url.'auth/login');
	}

}