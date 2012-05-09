<?php

class Layla_Client_Auth_Controller extends Layla_Base_Controller {

	public $meta_title = 'Authentication';

	public function get_login()
	{
		$this->layout->content = View::make('layla_client::auth.login');
	}

	public function put_login()
	{
		$rules = array(
			'email' => 'required|email',
			'password' => 'required',
		);

		$validator = new Validator(Input::all(), $rules);
		if ($validator->valid())
		{
			if (Auth::attempt(Input::get('email'), Input::get('password')))
			{
				return Redirect::to($this->url.'accounts');
			}
		}

		return Redirect::to($this->url.'auth/login')->with('errors', $validator->errors)->with_input('except', array());
	}

	public function get_logout()
	{
		Auth::logout();

		return Redirect::to($this->url.'auth/login');
	}

}