<?php

/**
 * 
 * Error codes:
 *  10 = Success
 *  20 = Table doesn't exist
 *  30 = No table set
 *  40 = No tables found
 */
class DBManager
{

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
		$this->pdo = DB::connection('mysql')->pdo;
	}

	/**
	 * tables
	 *
	 * @param string $name The table name we want more info from
	 * @return DBManager
	 */
	public static function table($table)
	{
		$dbm = new static;
		$dbm->table = $table;
		return $dbm;
	}

	/**
	 * Return all tables we're allowed to use
	 *
	 * @return array
	 */
	public static function tables()
	{
		$dbm = new static;

		foreach($dbm->pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_NUM) as $table)
		{
			$ignore = false;
			$table = $table[0];

			foreach ($dbm->ignore as $start)
			{
				if(starts_with($table, $start))
				{
					$ignore = true;
				}
			}

			if( ! $ignore)
			{
				$dbm->tables[] = $table;
			}
		}

		return $dbm->tables;
	}

	/**
	 * Get all column info from the specified table
	 *
	 * @param string $table
	 * @return array
	 */
	public function info($table = null)
	{
		if( ! is_null($table))
		{
			$this->table = $table;
		}
		if( ! empty($this->table))
		{
			try
			{
				$table = $this->table;
				$sql = "SHOW FULL COLUMNS FROM `$table`";
				$column_info = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

				foreach($column_info as $column)
				{
					$field = $column['field'];
					unset($column['field']);

					$this->table_info[$table][$field] = $column;
				}

				return $this->table_info[$table];
			}
			catch (PDOException $e)
			{
				switch ($e->errorInfo[1]) {
					case 1146:
					default:
						$status = 20;
						break;
				}
			}

		}
		else
		{
			$status = 30;
		}

		return array('status_code' => $status);

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