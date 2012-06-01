<?php namespace Blog\Domain\Models;

use Domain\Libraries\Model as Eloquent;

class Comment extends Eloquent {

	public function comments()
	{
		return $this->belongs_to('Blog\\Domain\\Models\\Post');
	}

}