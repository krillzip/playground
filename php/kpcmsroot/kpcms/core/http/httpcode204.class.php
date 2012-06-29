<?php

require_once('kpcms/core/http/httpcode.abstract.php');
require_once('kpcms/core/http/httpmessagedata.class.php');
require_once('kpcms/core/http/httpresponseheaders.class.php');
require_once('kpcms/core/http/httpgeneralheaders.class.php');
require_once('kpcms/core/http/httpentityheaders.class.php');

class HTTPCode204 extends HttpCode
{
	public function __construct($mdata)
	{
		if(get_class($mdata) !== 'HTTPMessageData')
			throw new Exception('Argument 1 to method HTTPCode204::__construct() not a class HTTPMessageData!');			
		$t = NULL;
		parent::AddHeader('HTTP/1.1 204 No Content');
		parent::AddHeader(HTTPResponseHeaders::AcceptRanges());
		if(($t = $mdata -> GetMethods()) !== NULL)
			parent::AddHeader(HTTPEntityHeaders::Allow($t));
		if($mdata -> GetProtected() === False)
			parent::AddHeader(HTTPGeneralHeaders::CacheControl());
		else
			parent::AddHeader(HTTPGeneralHeaders::CacheControl(2, False));
		parent::AddHeader(HTTPGeneralHeaders::Connection());
		parent::AddHeader(HTTPGeneralHeaders::Date());
		parent::AddHeader(HTTPEntityHeaders::Expires($mdata -> GetExpiration()));
		parent::AddHeader(HTTPEntityHeaders::LastModified($mdata -> GetModified()));
		parent::AddHeader(HTTPResponseHeaders::Server());
		if($_SERVER['SERVER_PROTOCOL'] !== 'HTTP/1.1')
			parent::AddHeader(HTTPGeneralHeaders::Upgrade());
	}
}

?>