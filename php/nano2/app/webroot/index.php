<?php

define('DS', DIRECTORY_SEPARATOR);
	
// Setting up some basic but vital paths.
define('APPLICATION_PATH', dirname(dirname(__FILE__)));
define('PLUGINS_PATH', dirname(dirname(dirname(__FILE__))).DS.'plugins');
define('NANO_PATH', dirname(dirname(dirname(__FILE__))).DS.'nano');
define('WEBROOT', dirname(__FILE__));
define('APPURL', 'http://localhost');

define('PRODUCTION', false);

require_once(NANO_PATH.DS.'bootstrap.php');

?>