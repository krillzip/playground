<?php

class HTTPGeneralHeaders
{
	public function __construct()
	{
	
	}
	
	public function __destruct()
	{
	
	}
	
	public static function CacheControl($cache = 0, $store = True) // THis function only implements some Cache-Control directives for response
	{
		$directive = NULL;
		
		switch($cache)
		{
		case 1:
			$directive .= 'private=\"all\"';
			break;
		case 2:
			$directive .= 'no-cache=\"all\"';
			break;
		case 0:
		default:
			$directive .= 'public';
			break;
		}
		
		if($store === False)
		{
			$directive .= ', no-store';
		}
		
		if($directive !== NULL)
		{
			return 'Cache-Control: ' . $directive;
		}
		else
		{
			return '';
		}
	}
	
	public static function Connection() // Don't know yet if Cache-Control must be excluded, or what it means.
	{
		return 'Connection: close';
	}
	
	public static function Date()
	{
		return 'Date: ' . date(DATE_RFC1123);
	}
	
	public static function Upgrade($p = 'HTTP/1.1')
	{
		return 'Upgrade: ' . $p;	
	}
}

?>
