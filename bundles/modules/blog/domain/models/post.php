<?php namespace Blog\Domain\Models;

use Domain\Libraries\Model as Eloquent;

class Post extends Eloquent {

	public function comments()
	{
		return $this->has_many('Blog\\Domain\\Models\\Comment');
	}

}