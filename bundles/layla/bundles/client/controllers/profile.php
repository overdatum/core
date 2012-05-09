<?php

class Layla_Client_Auth_Controller extends Layla_Base_Controller {

	/**
	 * Setting the page title
	 * 
	 * @var string
	 */
	public $meta_title = 'Profile';

	public function get_index()
	{
		$this->layout->content = View::make('layla_client::profile.index');
	}

}