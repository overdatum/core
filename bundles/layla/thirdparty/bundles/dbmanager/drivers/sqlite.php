<?php namespace DBManager\Drivers; 

use DBManager;
use Laravel\Config;
use Exception;
use PDO;

class SQLite extends Driver {

	/**
	 * Driver specific hidden tables
	 *
	 * @var array
	 **/
	public static $driver_hidden = array('sqlite_sequence');

	/**
	 * Return all tables we're allowed to use
	 *
	 * @return array
	 * // pgsql:  $query_string = "SELECT tablename FROM pg_tables WHERE tablename !~ '^pg_+' AND tableowner = '" . $connection['username'] ."'";
	 */
	public function get_tables()
	{
		$sql = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name";
		foreach($this->pdo->query($sql)->fetchAll(PDO::FETCH_NUM) as $table)
		{
			if( ! in_array($table[0], DBManager::$hidden))
			{
				$this->tables[] = $table[0];
			}
		}

		return $this->tables;
	}

	/**
	 * Get all column info from the specified table
	 *
	 * @return array
	 */
	public function info()
	{
		if(empty($this->table))
		{
			throw new Exception("No table set");
		}

		$table = $this->table;

		try
		{
			$this->table_info = $this->pdo->query("pragma table_info($table)")->fetchAll(PDO::FETCH_ASSOC);
		}
		catch (Exception $e)
		{
			throw new Exception($e->errorInfo[2]);
		}

		return $this->table_info;

	}

	/**
	 * Set
	 *
	 * @param string|array $field
	 * @param string|array $property
	 * @param string|array $value
	 * @return DBManager
	 */
	public function set($field, $properties)
	{
		return $this;
	}

}