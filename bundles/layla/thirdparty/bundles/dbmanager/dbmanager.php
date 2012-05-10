<?php defined('DS') or die('No direct script access.');

class DBManager {

	/**
	 * All of the active DBManager drivers.
	 *
	 * @var array
	 */
	public static $drivers = array();

	/**
	 * The tables that should be hidden
	 * 
	 * @var array
	 */
	public static $hidden = array();

	/**
	 * Get a DBManager driver instance.
	 *
	 * If no driver name is specified, the default will be returned.
	 *
	 * <code>
	 *		// Get the default DBManager driver instance
	 *		$driver = DBManager::driver();
	 *
	 *		// Get a specific DBManager driver instance by name
	 *		$driver = DBManager::driver('mysql');
	 * </code>
	 *
	 * @param  string        $driver
	 * @return DBManager\Drivers\Driver
	 */
	public static function driver($driver = null)
	{
		if (is_null($driver)) $driver = Config::get('database.connections.'.Config::get('database.default').'.driver');

		if ( ! isset(static::$drivers[$driver]))
		{
			static::$drivers[$driver] = static::factory($driver);
		}

		return static::$drivers[$driver];
	}

	/**
	 * Create a new DBManager driver instance.
	 *
	 * @param  string  $driver
	 * @return DBManager\Drivers\Driver
	 */
	protected static function factory($driver)
	{
		switch ($driver)
		{
			case 'mysql':
				return new DBManager\Drivers\MySQL;

			case 'pgsql':
				return new DBManager\Drivers\Postgres;

			default:
				throw new \Exception("DBManager driver {$driver} is not supported.");
		}
	}

	/**
	 * Magic Method for calling the methods on the default DBManager driver.
	 *
	 * <code>
	 *		// Call the "tables" method on the default DBManager driver
	 *		$name = DBManager::tables();
	 * </code>
	 */
	public static function __callStatic($method, $parameters)
	{
		return call_user_func_array(array(static::driver(), $method), $parameters);
	}

}
