<?php namespace DBManager\Drivers;

class MySQL extends Driver {

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

		$connection_string = Config::get('database.default');
		$connection = Config::get('database.connections.' . $connection_string);
		switch($connection['driver'])
		{
			case 'pgsql':
				$query_string = "SELECT tablename FROM pg_tables WHERE tablename !~ '^pg_+' AND tableowner = '" . $connection['username'] ."'";
			break;
			case 'mysql':
				$query_string = "SHOW TABLES";
			break;
		}

		foreach($dbm->pdo->query($query_string)->fetchAll(PDO::FETCH_NUM) as $table)
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
	public function info()
	{
		if(is_null($this->table))
		{
			throw new Exception("No table set", 30);
		}

		try
		{
			$table = $this->table;
			$sql = "SELECT column_name FROM `information_schema.columns` WHERE table_name = `$table`";
			$column_info = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			var_dump($column_info); die;
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

		return array('status_code' => $status);
	}

}