<?php

require_once('kpcms/core/http/httprequest.class.php');
$GLOBALS['REQUEST'] = new HTTPRequest();

require_once('kpcms/core/http/httprespond.class.php');
$GLOBALS['RESPOND'] = new HTTPRespond();

?>