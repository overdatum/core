<?php

class Page extends Eloquent {
	
	public function template()
	{
		return $this->belongs_to('Template');
	}

}