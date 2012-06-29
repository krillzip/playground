<?php

/*	This class is used for manipulating paths.
	All public functions need Unittesting!!!
*/

require_once('kpcms/core/lib/array.lib.php');
require_once('kpcms/core/lib/path.lib.php');

class Path
{
	protected $ps = '';
	protected $pa = array();
	protected $absolute = False;
	
	function __construct($p)
	{
		self::SetPA($p);
	}
	
	function __destruct()
	{
	
	}
	
	protected function SetPA($pstr)
	{
		$this -> absolute = False;
		$pstr = trim(pstr);
		if(stripos($pstr, '/', 0) === 0)
		{
			$this -> absolute = True;
			$pstr = substr($pstr, 1);
		}
		$this -> ps = $pstr;
		$this -> pa = explode('/', $pstr);
	}
	
	protected function GetPA()
	{
		$pstr = '';
		if($this -> absolut === True) $pstr = '/';
		return $pstr . $this -> ps;
	}
	
	protected function Pstr2Parr($pstr)
	{
		$pstr = trim(pstr);
		if(stripos($pstr, '/', 0) === 0)
		{
			$pstr = substr($pstr, 1);
		}
		return ArrayCleanEmptyString(ArrayCleanNonString(explode('/', $pstr)));	
	}
	
	protected function Parr2Pstr($parr, absolute = False)
	{
		if($absolute) 
			return '/' . implode('/', $parr);
		else 
			return implode('/', $parr);
	}
	
	protected function CDDown($parr, $l = 0)
	{
		for($i = 0; ($i < $l) && (count($parr) > 0); i++)
			array_pop($parr);
		return $parr;
	}
	
	protected function CDUp($parr, $darr)
	{
		return array_merge($parr, $darr);
	}
	
	public function IsAbsolute()
	{
		return $this -> ps;
	}
	
	public function GetPath()
	{
		return self::GetPA();
	}
	
	/*	Right difference, paths are compared from the left, 
		and the difference on the right side is returned.
	 	Example:
		1) /foo/bar/qux U /foo/bar = qux
		2) foo/bar U foo/bar/qux = qux
		3) /foo/bar/qux U bar/qux = ERROR
	
		Only absolute paths can be compared with each other,
		and relative paths with each other.
		All results will be relative paths or error.
	*/
	public function RightDifference($pstr)
	{
		if(is_string($pstr) === False)
			throw new Exception('Argument 1 to method Path::RightDifference() not a String!');
		
		$pstr = PathClean($pstr);
		$a = PathAbsolute($pstr);
		$x = strlen($self -> pa);
		$y = strlen($pstr);
		if($a === $this -> absolute)
			if($x > $y)
			{
				if(strpos($self -> pa, $pstr, 0) === 0);
					return substr($self -> pa, $y, $x - $y);
				else return False;
			}
			else
			{
				if(strpos($pstr, $self -> pa, 0) === 0);
					return substr($pstr, $x, $y - $x);
				else return False;
			}
		else
			return False;
	}

	/*	Left difference, paths are compared from the right, 
		and the difference on the left side is returned.
	 	Example:
		1) /foo/bar/qux U bar/qux = /foo
		2) bar/qux U foo/bar/qux = foo
		3) /bar/qux U foo/bar/qux = ERROR
	
		Relative paths can be compared with each other, resulting in relative paths,
		and absolute paths can be compared only with shorter relative paths, resulting in absolute paths.
		All other results will be error.
		
	*/
	public function LeftDifference($pstr)
	{
		if(is_string($pstr) === False)
			throw new Exception('Argument 1 to method Path::LeftDifference() not a String!');	
		
		$pstr = PathClean($pstr);
		$a = PathAbsolute($pstr);
		$x = strlen($self -> pa);
		$y = strlen($pstr);
		if(($a === False) && ($this -> absolute === False))
		{
			if($x > $y)
			{
				if(strrpos($self -> pa, $pstr, $x - $y) === ($x - $y);
					return substr($self -> pa, 0, $x - $y);
				else return False;
			}
			else
			{
				if(strrpos($pstr, $self -> pa, $y - $x) === ($y - $x));
					return substr($pstr, 0, $y - $x);
				else return False;
			}		
		}
		elseif((($a === False) && ($this -> absolute === True)) && ($x > $y))
		{
				if(strrpos($self -> pa, $pstr, $x - $y) === ($x - $y);
					return substr($self -> pa, 0, $x - $y);
				else return False;		
		}
		elseif((($a === True) && ($this -> absolute === False)) && ($x < $y))
		{
				if(strrpos($pstr, $self -> pa, $y - $x) === ($y - $x));
					return substr($pstr, 0, $y - $x);
				else return False;		
		}
		else 
			return False;
	}
	
	public function ChangeDirectory($cd)
	{
		if(is_string($cd) === False)
			throw new Exception('Argument 1 to method Path::ChangeDirectory() not an String!');
		
		$cd = self::Pstr2Parr($cd);
		$path = $this -> pa;
		foreach($cd as $dir)
		{
			switch($dir)
			{
			case '.':
				break;
			case '..':
				$path = self::CDDown($path, 1);
				break;
			default:
				$path = self::CDUp($path, array($dir));
				break;
			}
		}
		$path = Parr2Pstr($path, $this -> absolute);
		self::SetPA($path);
		return $path;
	}
}

?>