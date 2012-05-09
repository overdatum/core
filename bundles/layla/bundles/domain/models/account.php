<?php

class Account extends Eloquent {
	
	public function roles()
	{
		return $this->has_many_and_belong_to('Role');
	}

}