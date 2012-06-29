<?php

// Setting the error reporting to the strictest level.
error_reporting(E_ALL | E_STRICT);

// Sets standard definitions if not set in the applications /webroot/index.php file.
if(!defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);

if(!defined('APPLICATION_PATH'))
	define('APPLICATION_PATH', dirname(__FILE__).DS.'app');

if(!defined('PLUGINS_PATH'))
	define('PLUGINS_PATH', dirname(__FILE__).DS.'plugins');

if(!defined('NANO_PATH'))
	define('NANO_PATH', dirname(__FILE__).DS.'nano');

// WEBROOT must be defined in the applications /webroot/index.php file.
if(!defined('WEBROOT'))
	throw new Exception('The WEBROOT definition doesn\'t exist! Declare this definition in your webroot/index.php');

if(!defined('APPURL'))
	throw new Exception('The Web app URL isn\'t defined in your webroot/index.php');

if(!defined('DEBUGGING'))
	 define('DEBUGGING', false);

if(!defined('PRODUCTION'))
	 define('PRODUCTION', true);

require_once(NANO_PATH.DS.'Nano.php');

try
{
    Nano::initialize();
    Nano::execute();
    Nano::finalize();
}
catch(Exception $e)
{
	echo '<span style="color: red;">Yaiks! an error occured:</span><br />' . $e->getMessage();
	echo $e->getTraceAsString();
}

?>