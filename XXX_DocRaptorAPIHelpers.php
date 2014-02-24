<?php

// https://docraptor.com/documentation

abstract class XXX_DocRaptorAPIHelpers
{
	public static function doPOSTRequest ($uri = '', $data = array())
	{
		$result = false;
		
		$response = XXX_HTTP_Request::execute($uri, 'body', $data);
		
		if ($response != false)
		{
			$result = $response;
		}
		
		return $result;
	}
		
	public static function addAuthenticationToPath ($path = '', $authenticationType = 'none', $apiKey = '')
	{
		switch ($authenticationType)
		{
			case 'key':
			case 'apiKey':
				$path .= '&user_credentials=' . urlencode($apiKey);
				break;
			case 'none':
			default:
				break;
		}
		
		return $path;
	}
}

?>