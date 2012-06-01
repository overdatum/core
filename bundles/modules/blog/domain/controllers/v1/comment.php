<?php

use Blog\Domain\Models\Comment;

class Blog_Domain_V1_Comment_Controller extends Domain_Base_Controller {
	
	public function __construct()
	{
		$this->model = new comment;
	}

	/**
	 * Get all comments
	 *
	 * @return Response
	 */
	public function get_comment_all()
	{
		return $this->get_multiple();
	}

	/**
	 * Get comment by id
	 *
	 * @return Response
	 */
	public function get_comment($id)
	{
		return $this->get_single($id);
	}

	/**
	 * Add comment
	 *
	 * @return Response
	 */
	public function post_comment()
	{
		$comment = $this->model();

		return $this->create_single(Input::all());
	}

	/**
	 * Edit comment
	 *
	 * @return Response
	 */
	public function put_comment($id)
	{
		// Find the comment we are updating
		$comment = $this->model($id);
			
		return $this->update_single(Input::all());
	}

	/**
	 * Delete comment
	 *
	 * @return Response
	 */
	public function delete_comment($id)
	{
		$this->model($id);

		$this->delete_single();
	}

}