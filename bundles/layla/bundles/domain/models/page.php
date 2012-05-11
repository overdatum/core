<?php

class Page extends Eloquent {
	
	public function template()
	{
		return $this->belongs_to('Template');
	}

	public function lang()
	{
		//$language_id = Session::get('layla.language');
		return $this->has_one('Lang');//->where_language_id();
	}

	public function account()
	{
		return $this->belongs_to('Account', 'account_id');
	}

}