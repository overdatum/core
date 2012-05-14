<?php namespace DBManager\Drivers;

use DBManager;
use Laravel\Config;
use Exception;
use PDO;

class Postgres extends Driver {

	/**
	 * Driver specific hidden tables
	 *
	 * @var array
	 **/
	public static $driver_hidden = array();

	/**
	 * Return all tables we're allowed to use
	 *
	 * @return array
	 */
	public function get_tables()
	{
		$sql = "SELECT tablename FROM pg_tables WHERE tablename !~ '^pg_+' AND tableowner = '" . $this->config['username'] ."'";
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
			$columns = $this->pdo->query("SELECT * FROM information_schema.columns WHERE table_name = '$table'")->fetchAll(PDO::FETCH_ASSOC);
			foreach ($columns as $column) {
				$this->table_info[] = array(
					'name' => $column['column_name'],
					'type' => $column['data_type'],
					'nullable' => $column['is_nullable'] == 'NO' ? false : true,
					'default' => $column['column_default'],
					'size' => $column['data_type'] == 'integer' ? $column['numeric_precision'] : $column['character_maximum_length']					
				);					
			}
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
	 * @param string|array $properties
	 * @param string|array $value
	 * @return DBManager
	 */
	public function set($field, $properties)
	{
		return $this;
	}

}