<?php

function __autoload($class)
{
   require_once('kpcms/core/http/' . $class . '.class.php');
}

class HTTPRespond
{
	private $Header = '';
	private $Message = '';
	private $s = False;
	
	public function __construct()
	{
		self::Reset();
	}
	
	public function SetCode($code, $mes, $mdata)
	{
		$this -> Message = $mes;
		$h = NULL;
		
		switch($code)
		{
		case 200: // OK
			$h = new HTTPCode200($mdata);
			break;
		case 204: // No Content
			$h = new HTTPCode204($mdata);
			break;
		case 301: // Moved Permanently
			$h = new HTTPCode301($mdata);
			break;
		case 400: // Bad Request
			$h = new HTTPCode400($mdata);
			break;
		case 403: // 403 Forbidden
			$h = new HTTPCode403($mdata);
			break;
		case 404: // Not Found
			$h = new HTTPCode404($mdata);
			break;
		case 405: // Method Not Allowed
			$h = new HTTPCode405($mdata);
			break;
		case 410: // Gone
			$h = new HTTPCode410($mdata);
			break;
		case 415: // Unsupported Media Type
			$h = new HTTPCode415($mdata);
			break;
		case 501: // Not Implemented
			$h = new HTTPCode501($mdata);
			break;
		case 503: // Service Unavailable
			$h = new HTTPCode503($mdata);
			break;
		case 505: // HTTP Version Not Supported
			$h = new HTTPCode505($mdata);
			break;
		case 500: // Internal Server Error
		default:
			$h = new HTTPCode500($mdata);
			break;
		}
		$this -> Header = array();
		$this -> Header = $h -> GenerateHeader();
		$this -> s = True;
	}
	
	public function __destruct()
	{
	
	}
	
	public function Flush()
	{
		ob_clean();
		foreach($this -> Header as $h)
			header($h);
			
		print($this -> Message);
		flush();
	}
	
	public function Reset()
	{
		$this -> Header = '';
		$this -> Message = '';
		$this -> s = False;
	}
	
	public function IsInit()
	{
		return $this -> s;
	}
}

?>