<?php

class HTTPMessageData
{
	public $cacheage		= NULL; // The age of the server cachecopy if cached, Unix timestamp.
	public $expires			= NULL; // Expiration date, if no date should be implemented as forever, Unix timestamp.
	public $messagelength	= NULL;
	public $messagemd5		= NULL;
	public $messagemime		= NULL;
	public $methods			= NULL; // Allowed methods for the current URL.
	public $language		= NULL; // Language of the current URL.
	public $lastmodified	= NULL; // Last modified date Unix timestamp.
	public $coding			= NULL; // Encoding format of the message.
	public $protect			= False;
	public $redirect		= False;
	
	public function __construct()
	{

	}
	
	public function __destruct()
	{
	
	}
	
	public function GetAge()
	{
		return $this -> cacheage;
	}
	
	public function GetExpiration()
	{
		return $this -> expires;
	}
	
	public function GetLength()
	{
		return $this -> messagelength;
	}
	
	public function GetMD5()
	{
		return $this -> messagemd5;
	}
	
	public function GetMethods()
	{
		return $this -> methods;
	}
	
	public function GetLanguage()
	{
		return $this -> language;
	}
	
	public function GetModified()
	{
		return $this -> lastmodified;
	}
	
	public function GetEncoding()
	{
		return $this -> coding;
	}
	
	public function GetProtected()
	{
		return $this -> protect;
	}
	
	public function GetMime()
	{
		return $this -> messagemime;
	}
	
	public function GetRedirect()
	{
		return $this -> redirect;
	}
}

?>