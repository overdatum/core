<?php

use Blog\Domain\Models\Post;

class Blog_Domain_V1_Post_Controller extends Domain_Base_Controller {
	
	public function __construct()
	{
		$this->model = new Post;
	}

	/**
	 * Get all posts
	 *
	 * @return Response
	 */
	public function get_post_all()
	{
		$this->includes = array('comments');

		return $this->get_multiple();
	}

	/**
	 * Get post by id
	 *
	 * @return Response
	 */
	public function get_post($id)
	{
		$this->includes = array('comments');

		return $this->get_single($id);
	}

	/**
	 * Add post
	 *
	 * @return Response
	 */
	public function post_post()
	{
		$post = $this->model();

		return $this->create_single(Input::all());
	}

	/**
	 * Edit post
	 *
	 * @return Response
	 */
	public function put_post($id)
	{
		// Find the post we are updating
		$post = $this->model($id);
			
		return $this->update_single(Input::all());
	}

	/**
	 * Delete post
	 *
	 * @return Response
	 */
	public function delete_post($id)
	{
		$this->model($id);

		$this->delete_single();
	}

}