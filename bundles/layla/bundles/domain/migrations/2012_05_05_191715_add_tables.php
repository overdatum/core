<?php

class Layla_Domain_Add_Tables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function($table)
		{
			$table->increments('id');
			$table->integer('language_id');
			$table->string('email');
			$table->string('password');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('roles', function($table)
		{
			$table->increments('id');
			$table->string('name');
		});

		Schema::create('account_role', function($table)
		{
			$table->increments('id');
			$table->integer('account_id');
			$table->integer('role_id');
			$table->timestamps();
		});

		Schema::create('pages', function($table)
		{
			$table->increments('id');
			$table->integer('template_id');
			$table->timestamps();
		});

		Schema::create('page_lang', function($table)
		{
			$table->increments('id');
			$table->integer('page_id');
			$table->integer('language_id');
			$table->integer('active');
			$table->timestamps();
		});

		Schema::create('templates', function($table)
		{
			$table->increments('id');
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

		Schema::create('languages', function($table)
		{
			$table->increments('id');
			$table->string('name');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts');
		Schema::drop('roles');
		Schema::drop('account_role');
		Schema::drop('pages');
		Schema::drop('page_lang');
		Schema::drop('templates');
		Schema::drop('regions');
		Schema::drop('region_module');
		Schema::drop('modules');
		Schema::drop('languages');
	}

}