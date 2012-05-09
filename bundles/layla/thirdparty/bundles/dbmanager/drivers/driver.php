<?php namespace DBManager\Drivers;

class Driver {

	/**
	 * These tables will be ignored because they are system tables
	 *
	 * @var array
	 **/
	private $ignore = array(
		'laravel_migrations',
		'layouts',
		'modules',
		'roles',
		'users',
		'regions',
		'region_module',
		'sessions'
	);

	/**
	 * PDO var
	 *
	 * @var
	 **/
	private $pdo;

	/**
	 * The table we are working on
	 *
	 * @var string
	 **/
	public $table;

	/**
	 * Table info for the table we are working on
	 *
	 * @var object
	 **/
	public $table_info;

	/**
	 * Tables
	 *
	 * @var array
	 **/
	public $tables = array();

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->pdo = DB::connection()->pdo;
	}

	/**
	 * Set
	 *
	 * @param string|array $field
	 * @param string|array $property
	 * @param string|array $value
	 * @return DBManager
	 */
	public function set($field, $property, $value)
	{
		return $this;
	}

	/**
	 * __toString
	 *
	 * @return array
	 */
	public function __toString()
	{
		return $this->tables;
	}

}