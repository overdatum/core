<?php namespace DBManager\Drivers; use Laravel\Config as Config;

class MySQL extends Driver {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Return all tables we're allowed to use
	 *
	 * @return array
	 * // pgsql:  $query_string = "SELECT tablename FROM pg_tables WHERE tablename !~ '^pg_+' AND tableowner = '" . $connection['username'] ."'";
	 */
	public static function tables()
	{
		$dbm = new static;
		$sql = "SHOW TABLES";
		foreach($dbm->pdo->query($sql)->fetchAll(\PDO::FETCH_NUM) as $table)
		{
			if( ! in_array($table[0], $dbm->no_access))
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
	public function info()
	{
		if(is_null($this->table))
		{
			throw new \Exception("No table set");
		}

		$table = $this->table;

		try
		{
			$sql = "SHOW FULL COLUMNS FROM `$table`";
			$column_info = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

			$this->table_info = $column_info;

		}
		catch (\Exception $e)
		{
			throw new \Exception($e->errorInfo[2]);
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

	/**
	 * new_table
	 *
	 * @return void
	 */
	public static function new_table($table)
	{
		return $this;
	}

}