<?php

class DocumentXML extends DOMDocument
{
	protected	$mode;
	protected	$path;
	protected	$xml;
	protected	$type;
	
	function __construct($p, $m = 'r')
	{
		$e = NULL;
		parent::__construct('1.0', 'iso-8859-1');
		$this -> mode = $m;
		$this -> path = $p;
		switch($m)
		{
		case 'r':
			$f = file_get_contents($p);
			if($f === False)
			{
				$e = 'DocumentXML::__construct() could not open file: ' . $p . '.';
				break;
			}
			else
			{
			
			}
			parent::load($p);
			break;
		case 'w+':
			$f = file_get_contents($p);
			if($f === False)
			{ 
				$e = 'DocumentXML::__construct() could not open file: ' . $p . '.';
				break;
			}
			else
			{
			
			}
			parent::load($p);
			break;
		case 'x+':
			$parts = pathinfo($p);
			$s = is_dir($parts['dirname']);
			if(!$s) $e = 'DocumentXML::__construct(), ' . $p . ' is not a valid directory.';
			break;
		default:
			 $e = 'Scond argument to DocumentXML::__construct() is not a valid mode, only r w+ and x+ available.';
			break;
		}
		if($e !== NULL)
			throw new Exception($e);
	}
	
	function __destruct()
	{
	
	}
	
	public function SaveFile()
	{
	
	}
	
	public function GetXML()
	{
	
	}
	
	public function SetXML($x)
	{
	
	}
	
	public function GetFileType()
	{
	
	}
	
	public function SetFileType()
	{
	
	}
	
	protected function ValidateDocument()
	{
		
	}
}

?>
