<?php

define('DS', DIRECTORY_SEPARATOR);
	
// Setting up some basic but vital paths.
define('WEBROOT', dirname(__FILE__));
define('APPURL', 'http://localhost');

define('PRODUCTION', false);

require_once(dirname(dirname(dirname(__FILE__))).DS.'bootstrap.php');

?>