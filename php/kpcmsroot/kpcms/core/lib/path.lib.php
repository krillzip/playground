<?php

require_once('kpcms/core/lib/array.lib.php');

function PathAbsolute($pstr)
{
	if(is_string($pstr) === False)
		throw new Exception('Argument 1 to method PathAbsolute() not a String!');	
			
	if(stripos($pstr, '/', 0) === 0) return True;
	return False;
}

function PathClean($pstr)
{
	if(is_string($pstr) === False)
		throw new Exception('Argument 1 to method PathClean() not a String!');	
		
	$pstr = trim($pstr);
	$a = PathAbsolute($pstr);
	$arr = ArrayCleanEmptyString(ArrayCleanNonString(explode('/', $pstr)));
	$pstr = implode('/', $arr);
	if($a)
		$pstr = '/' . $pstr;
	return $pstr;		
}

?>
