<?php namespace Layla\Client\API\Drivers;

use Layla\Client\APIResponse;

use Laravel\Config;
use Exception;

class JSON extends Driver {

	public static function call($method, $arguments, $input = array(), $segments = array())
	{
		$url = Config::get('layla_client::install.api.url') . '/api/' . implode('/', $arguments) . (count($segments) > 0 ? '?' . http_build_query($segments) : '');

		$method = strtoupper($method);

		$headers = array(
			'accept: application/json',
			'content-type: application/json',
		);

		$data = json_encode($input);

		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_USERPWD, "loginname:passwort");
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		
		if($method !== 'GET' && $method !== 'DELETE')
		{
 			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}

		$body = curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		$content = '';
		if(in_array($code, array(200, 400)))
		{
			$content = $body;
		}

		return new APIResponse($code, json_decode($content));
	}

}