<?php namespace DBManager\Drivers; use Laravel\Database as DB; use Laravel\Config as Config; use PDO;

class Driver {

	/**
	 * These tables will be ignored because they are system tables
	 *
	 * @var array
	 **/
	protected $no_access;

	/**
	 * PDO var
	 *
	 * @var
	 **/
	protected $pdo;

	/**
	 * The table we are working on
	 *
	 * @var string
	 **/
	protected $table;

	/**
	 * Table info for the table we are working on
	 *
	 * @var object
	 **/
	protected $table_info;

	/**
	 * Tables
	 *
	 * @var array
	 **/
	protected $tables = array();

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->no_access = Config::get('layla::dbmanager.ignore');
		$this->pdo    = DB::connection()->pdo;
	}

	/**
	 * table
	 * 
	 * @param string $name The table name we are on
	 * @return static
	 */
	public static function table($table)
	{
		$dbm = new static;

		if(in_array($table, $dbm->no_access))
		{
			throw new \Exception("Not allowed");	
		}

		$dbm->table = $table;

		return $dbm;
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