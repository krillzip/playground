<?php

class HTTPEntityHeaders
{
	public function __construct()
	{
	
	}
	
	public function __destruct()
	{
	
	}
	
	public static function Allow($m)
	{
		return 'Allow: ' . $m;
	}
	
	public static function ContentEncoding($e = '') // should only be used if encoded.
	{
		return 'Content-Encoding: ' . $e;
	}
	
	public static function ContentLanguage($l = 'en')
	{
		return 'Content-Language: ' . $l;
	}
	
	public static function ContentLength($le = '0')
	{
		return 'Content-Length: ' . $le;
	}
	
	public static function ContentMD5($m)
	{
		return 'Content-MD5: ' . $m;	
	}
	
	public static function ContentType($mime)
	{
		return 'Content-Type: ' . $mime;	
	}
	
	public static function Expires($d = NULL)
	{
		switch($d)
		{
		case NULL:
			return 'Expires: ' . date(DATE_RFC1123, time() + 31536000);
			break;
		case 0:
			return 'Expires: ' . date(DATE_RFC1123);	
			break;
		default:
			return 'Expires: ' . date(DATE_RFC1123, $d);
			break;
		}	
	}
	
	public static function LastModified($lm)
	{
		return 'Last-Modified: ' . date(DATE_RFC1123, $lm);
	}
}

?>
