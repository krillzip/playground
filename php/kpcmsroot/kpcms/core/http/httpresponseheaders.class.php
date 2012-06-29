<?php

class HTTPResponseHeaders
{
	public function __construct()
	{
	
	}
	
	public function __destruct()
	{
	
	}
	
	public static function AcceptRanges()
	{
		return 'Accept-Ranges: none';
	}
	
	public static function Age($t)
	{
		return 'Age: ' . time() - $t;
	}
	
	public static function Location($l)
	{
		return 'Location: ' . $l;
	}
	
	public static function RetryAfter($s = 60)
	{
		return 'Retry-After: ' . $s;	
	}
	
	public static function Server()
	{
		return 'Server: kpcms 0.1a';		
	}
}

?>
