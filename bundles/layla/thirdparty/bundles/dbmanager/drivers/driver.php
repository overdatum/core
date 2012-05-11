<?php namespace DBManager\Drivers;

use Exception;

use Laravel\Database as DB;
use Laravel\Config;
use PDO;

use DBManager;

class Driver {

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
		$this->pdo = DB::connection()->pdo;
		$this->config = Config::get('database.connections.'.Config::get('database.default'));
	}

	/**
	 * tables
	 *
	 * @return void
	 */
	public static function tables()
	{
		$tables = new static;
		return $tables->get_tables();
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

		if(in_array($table, DBManager::$hidden))
		{
			throw new Exception("Not allowed");	
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