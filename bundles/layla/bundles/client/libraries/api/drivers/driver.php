<?php namespace Layla\Client\API\Drivers;

abstract class Driver {

	public static function get($arguments, $segments = array())
	{
		return static::call('GET', $arguments, array(), $segments);
	}

	public static function post($arguments, $input = array())
	{
		return static::call('POST', $arguments, $input);
	}

	public static function put($arguments, $input = array())
	{
		return static::call('PUT', $arguments, $input);
	}

	public static function delete($arguments)
	{
		return static::call('DELETE', $arguments, array());
	}

}