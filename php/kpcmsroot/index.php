<?php
ob_start();

require_once('kpcms/core/globals.inc.php');
require_once('kpcms/core/http/httphandler.php');

HttpHandler();
die();
?>