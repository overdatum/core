<?php namespace Layla;

use Laravel\Config;

class API {

	/**
	 * All of the active API drivers.
	 *
	 * @var array
	 */
	public static $drivers = array();

	/**
	 * Get a API driver instance.
	 *
	 * If no driver name is specified, the default will be returned.
	 *
	 * <code>
	 *		// Get the default API driver instance
	 *		$driver = API::driver();
	 *
	 *		// Get a specific API driver instance by name
	 *		$driver = API::driver('mysql');
	 * </code>
	 *
	 * @param  string        $driver
	 * @return API\Drivers\Driver
	 */
	public static function driver($driver = null)
	{
		if (is_null($driver)) $driver = Config::get('layla::install.api.driver');

		if ( ! isset(static::$drivers[$driver]))
		{
			static::$drivers[$driver] = static::factory($driver);
		}

		return static::$drivers[$driver];
	}

	/**
	 * Create a new API driver instance.
	 *
	 * @param  string  $driver
	 * @return API\Drivers\Driver
	 */
	protected static function factory($driver)
	{
		switch ($driver)
		{
			case 'json':
				return new API\Drivers\JSON;

			case 'directly':
				return new API\Drivers\Directly;

			default:
				throw new \Exception("API driver {$driver} is not supported.");
		}
	}

	/**
	 * Magic Method for calling the methods on the default API driver.
	 *
	 * <code>
	 *		// Call the "call" method on the default API driver
	 *		$name = API::call();
	 * </code>
	 */
	public static function __callStatic($method, $parameters)
	{
		return call_user_func_array(array(static::driver(), $method), $parameters);
	}

}
