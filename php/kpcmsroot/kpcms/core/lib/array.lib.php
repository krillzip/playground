<?php

function ArrayCleanNonString($arr)
{
	if(!is_array($arr))
		throw new Exception('Argument 1 to function ArrayCleanNonString() not an Array!');

	foreach($array as $key => $value)
		if(is_string($value) === False) 
    		unset($array[$key]);
	return array_values($array);
}

function ArrayCleanEmptyString($arr)
{
	if(!is_array($arr))
		throw new Exception('Argument 1 to function ArrayCleanEmptyString() not an Array!');
		
	foreach($array as $key => $value)
		if($value == '') 
    		unset($array[$key]);
	return array_values($array);
}

?>