<?php

abstract class HTTPCode
{
	private $Header;
	
	abstract public function __construct($mdata);
	
	protected function AddHeader($h)
	{
		if(is_array($this -> Header) === False)
			$this -> Header = array();
			
		array_push($this -> Header, $h);
	}
	
	public function GenerateHeader()
	{
		return $this -> Header;
	}
}

?>