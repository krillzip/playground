<?php

/**
 * Reporting strict all errors.
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Application wide defines
 */
define('PRODUCTION', false);
define('DS', DIRECTORY_SEPARATOR);
define('WEBROOT', dirname(__FILE__));
define('NANO_PATH', dirname(dirname(__FILE__)).DS.'code'.DS.'framework');
define('APP_PATH', dirname(dirname(__FILE__)).DS.'code'.DS.'application');
define('VENDORS_PATH', dirname(dirname(__FILE__)).DS.'code'.DS.'vendors');

require_once(NANO_PATH.DS.'Nano.php');
Nano::init();
NApplication::getInstance()->run();
/*$html = Nano::f()->html;
$html->standard = 'nano.views.'.NHtml::STRICT;
$html->layout = 'nano.views.3columns';
$html->containers = array();
$html->view = 'app.views.default';

$html->content = array();
$html->render();*/