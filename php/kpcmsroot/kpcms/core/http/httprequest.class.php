<?php

class HTTPRequest
{
	public $Accept = NULL; // Accepted data formats by the client.
	public $Accept_Charset = NULL; // Accepted character sets by the client.
	public $Accept_Encoding = NULL; // Accepted data encoding standars by the client.
	public $Accept_Language = NULL; // What languages the client accepts.
	public $Connection = NULL; // What kind of connection the client wants.
	public $Referrer = NULL; // What link the client came from.
	public $Host = NULL; // The host of the referer according to the client. If missing respond 400.
	public $User_Agent = NULL; // The UserAgent of the program.
	public $Https = NULL; // If the client uses secure connection.
	public $Request_Method = NULL; // The method used by the client when doing the request.
	public $Request_Protocol = NULL; // The protocol used by the client when doing the request.
	
	function __construct()
	{
		if(isset($_SERVER['HTTP_ACCEPT'])) $this -> Accept = $_SERVER['HTTP_ACCEPT'];
		if(isset($_SERVER['HTTP_ACCEPT_CHARSET'])) $this -> Accept_Charset = $_SERVER['HTTP_ACCEPT_CHARSET'];
		if(isset($_SERVER['HTTP_ACCEPT_ENCODING'])) $this -> Accept_Encoding = $_SERVER['HTTP_ACCEPT_ENCODING'];
		if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) $this -> Accept_Language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		if(isset($_SERVER['HTTP_CONNECTION'])) $this -> Connection = $_SERVER['HTTP_CONNECTION'];
		if(isset($_SERVER['HTTP_REFERRER'])) $this -> Referrer = $_SERVER['HTTP_REFERRER'];
		if(isset($_SERVER['HTTP_HOST'])) $this -> Host = $_SERVER['HTTP_HOST'];
		if(isset($_SERVER['HTTP_USER_AGENT'])) $this -> User_Agent = $_SERVER['HTTP_USER_AGENT'];
		if(isset($_SERVER['HTTPS'])) $this -> Https = $_SERVER['HTTPS'];
		if(isset($_SERVER['REQUEST_METHOD'])) $this -> Request_Method = $_SERVER['REQUEST_METHOD'];
		if(isset($_SERVER['SERVER_PROTOCOL'])) $this -> Request_Protocol = $_SERVER['SERVER_PROTOCOL'];
	}
	
	function __destruct()
	{

	}
	
	/* Returns accepted data formats in an array, or false if missing */
	public function GetDataFormat()
	{
		if($this -> Accept !== NULL)
		{
			return split(',', $this -> Accept);
		}
		else return False;
	}
	
	/* Returns accepted charsets in an array, or false if missing */
	public function GetCharset()
	{
		if($this -> Accept_Charset !== NULL)
		{
			return split(',', $this -> Accept_Charset);
		}
		else return False;	
	}
	
	/* Returns accepted data encoding formats in an array, or false if missing */
	public function GetDataEncoding()
	{
		if($this -> Accept_Encoding !== NULL)
		{
			return split(',', $this -> Accept_Encoding);
		}
		else return False;	
	}
	
	/* Returns accepted languages in an array, or false if missing */
	public function GetLanguage()
	{
		if($this -> Accept_Language !== NULL)
		{
			return split(',', $this -> Accept_Language);
		}
		else return False;	
	}
	
	/* Returns kind of connection, or false if missing */
	public function GetConnection()
	{
		if($this -> Connection !== NULL)
		{
			return $this -> Connection;
		}
		else return False;	
	}
	
	/* Returns the referer the client came from, or false if missing */
	public function GetReferrer()
	{
		if($this -> Referrer !== NULL)
		{
			return $this -> Referrer;
		}
		else return False;	
	}
	
	/* Returns the host of the referrer, or false if missing */
	public function GetHost()
	{
		if($this -> Host !== NULL)
		{
			return $this -> Host;
		}
		else return False;	
	}
	
	/* Returns the client user-agent, or false if missing */
	public function GetUserAgent()
	{
		if($this -> User_Agent !== NULL)
		{
			return $this -> User_Agent;
		}
		else return False;	
	}
	
	/* Returns client method, or false if missing */
	public function GetMethod()
	{
		if($this -> Request_Method !== NULL)
		{
			return strtoupper($this -> Request_Method);
		}
		else return False;	
	}
	
	/* Returns protocol and version in string, or false if missing */
	public function GetProtocol()
	{
		if($this -> Request_Protocol !== NULL)
		{
			return $this -> Request_Protocol;
		}
		else return False;	
	}
}

?>