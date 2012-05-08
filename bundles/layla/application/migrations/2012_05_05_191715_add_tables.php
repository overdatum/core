<?php

class Layla_add_Tables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table)
		{
			$table->increments('id');
			$table->integer('template_id');
			$table->timestamps();
		});

		Schema::create('layouts', function($table)
		{
			$table->increments('id');
			$table->integer('template_id');
			$table->timestamps();
		});

		Schema::create('regions', function($table)
		{
			$table->increments('id');
			$table->integer('page_id');
			$table->integer('layout_id');
		});

		Schema::create('region_module', function($table)
		{
			$table->increments('id');
			$table->integer('region_id');
			$table->integer('module_id');
			$table->integer('order');
			$table->text('settings');
		});

		Schema::create('modules', function($table)
		{
			$table->increments('id');
			$table->integer('name');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
		Schema::drop('layouts');
		Schema::drop('regions');
		Schema::drop('region_module');
		Schema::drop('modules');
	}

}