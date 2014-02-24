<?php

class XXX_DocRaptorAPI_PDFService
{
	// Paid
	public static $apiKey = '';
	
	public static $httpsOnly = false;
	
	public static $authenticationType = 'free';
	
	public static $error = false;
	
	public static function generatePDFContent ($html = '', $file = '', $test = false)
	{
		$result = false;
		
		self::$error = false;
		
		// http://docraptor.com/docs?user_credentials=87ds87fd87df87
		
		if (self::$httpsOnly)
		{
			$protocol = 'https://';
		}
		else
		{	
			$protocol = 'http://';
			
			if (class_exists('XXX_HTTPServer') && XXX_HTTPServer::$encryptedConnection)
			{
				$protocol = 'https://';
			}
		}
		
		$domain = 'docraptor.com';
		$path = '/docs';
		$path .= '?';
		
		$data = array
		(
			'doc[document_type]' => 'pdf',
			'doc[document_content]' => $html,
			'doc[name]' => $file,
			'doc[test]' => $test ? 'true' : 'false',
			'doc[strict]' => 'none',
		);
				
		// Free
		$authenticationType = 'none';
		
		if (self::$authenticationType == 'paid')
		{
			$authenticationType = 'apiKey';
		}
		
		$path = XXX_DocRaptorAPIHelpers::addAuthenticationToPath($path, $authenticationType, self::$apiKey);
		
		$uri = $protocol . $domain . $path;
		
		echo $uri;
		
		$response = XXX_DocRaptorAPIHelpers::doPOSTRequest($uri, $data);
		
		if ($response != false)
		{
			$result = $response;
		}
		else
		{
			self::$error = 'Failed POST request';
		}
		
		return $result;
	}
}

?>