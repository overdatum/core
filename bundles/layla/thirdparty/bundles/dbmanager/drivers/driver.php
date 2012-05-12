<?php namespace DBManager\Drivers;

use Exception;

use Laravel\Database as DB;
use Laravel\Database\Schema;
use Laravel\Config;
use PDO;

use DBManager;

abstract class Driver {

	/**
	 * Driver specific hidden tables
	 *
	 * @var array
	 **/
	public static $driver_hidden = array();

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
	 * @var array
	 **/
	protected $table_info = array();

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
	 * Create a new table
	 * 
	 * <code>
	 * // input example
	 * $input = array(
	 *   'posts' => array(
	 *     'title' => array(
	 *       'type' => 'string',
	 *       'length' => 100,
	 *     ),
	 *   ),
	 *   // Can add multiple tables at once
	 *   'post_lang' => array(
	 *     'name' => array(
	 *       'type' => 'string',
	 *     ),
	 *     'locale' => array(
	 *       'type' => 'string',
	 *       'length' => 5,
	 *     ),
	 *   ),
	 * );
	 * 
	 * DBManager::new_table($input);
	 * 
	 * </code>
	 *
	 * @param array $input
	 * @return array
	 */
	public static function new_table($input)
	{
		foreach ($input as $table => $columns)
		{
			Schema::create($table, function($table) use($columns)
			{
				if( ! isset($columns['id']))
				{
					$table->increments('id');
				}

				foreach ($columns as $name => $data)
				{
					if(isset($data['length']) AND ! is_null($data['length']))
					{
						${$name} = $table->{$data['type']}($name, $data['length']);
					}
					else
					{
						${$name} = $table->{$data['type']}($name);
					}

					if(isset($data['nullable']) AND $data['nullable'] == true)
					{
						${$name}->nullable();
					}
				}

				$table->timestamps();
			});
		}

		return DBManager::tables();
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