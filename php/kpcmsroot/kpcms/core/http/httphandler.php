<?php

require_once('kpcms/core/globals.inc.php');
require_once('kpcms/core/http/httpstatuscodes.inc.php');
require_once('kpcms/core/http/httpmessagedata.class.php');

function HttpHandler()
{	
	switch($GLOBALS['REQUEST'] -> GetProtocol())
	{
	case 'HTTP/1.0':
	case 'HTTP/1.1':	
		switch($GLOBALS['REQUEST'] -> GetMethod())
		{
		/*case 'HEAD'://
			echo "Method HEAD";
			break;
		case 'GET'://
			echo "Method GET";
			break;
		case 'POST'://
			echo "Method POST";
		case 'PUT'://
			echo "Method PUT";
		case 'OPTIONS':
		case 'DELETE':
		case 'TRACE':
		case 'CONNECT':*/
		default:
			$GLOBALS['RESPOND'] -> Reset();
			$GLOBALS['RESPOND'] -> SetCode(501, $HTTPStatusCodes[501]);
			break;
		}
		break;
	default:
		$GLOBALS['RESPOND'] -> Reset();
		$GLOBALS['RESPOND'] -> SetCode(505, $HTTPStatusCodes[505]);
		break;
	}
	if($GLOBALS['RESPOND'] -> IsInit())
		$GLOBALS['RESPOND'] -> Flush();
	else 
	{
		$GLOBALS['RESPOND'] -> Reset();
		$GLOBALS['RESPOND'] ->SetCode(500, $HTTPStatusCodes[500], new HTTPMessageData($HTTPStatusCodes[500]));
		$GLOBALS['RESPOND'] -> Flush();
	}
}

?>