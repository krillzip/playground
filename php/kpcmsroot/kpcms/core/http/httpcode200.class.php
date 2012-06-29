<?php

require_once('kpcms/core/http/httpcode.abstract.php');
require_once('kpcms/core/http/httpmessagedata.class.php');
require_once('kpcms/core/http/httpresponseheaders.class.php');
require_once('kpcms/core/http/httpgeneralheaders.class.php');
require_once('kpcms/core/http/httpentityheaders.class.php');

class HTTPCode200 extends HttpCode
{
	public function __construct($mdata)
	{
		if(get_class($mdata) !== 'HTTPMessageData')
			throw new Exception('Argument 1 to method HTTPCode200::__construct() not a class HTTPMessageData!');
			
		$t = NULL;
		parent::AddHeader('HTTP/1.1 200 OK');
		parent::AddHeader(HTTPResponseHeaders::AcceptRanges());
		if(($t = $mdata -> GetAge()) !== NULL)
			parent::AddHeader(HTTPResponseHeaders::Age($t));
		if(($t = $mdata -> GetMethods()) !== NULL)
			parent::AddHeader(HTTPEntityHeaders::Allow($t));
		if($mdata -> GetProtected() === False)
			Parent::AddHeader(HTTPGeneralHeaders::CacheControl());
		else
			parent::AddHeader(HTTPGeneralHeaders::CacheControl(2, False));
		parent::AddHeader(HTTPGeneralHeaders::Connection());
		if(($t = $mdata -> GetLanguage()) !== NULL)	
			parent::AddHeader(HTTPEntityHeaders::ContentLanguage($t));
		else
			parent::AddHeader(HTTPEntityHeaders::ContentLanguage('all'));
		if(($t = $mdata -> GetLength()) !== NULL)	
			parent::AddHeader(HTTPEntityHeaders::ContentLength($t));
		if(($t = $mdata -> GetMD5()) !== NULL)
			parent::AddHeader(HTTPEntityHeaders::ContentMD5($t));
		parent::AddHeader(HTTPEntityHeaders::ContentType($mdata -> GetMime()));
		parent::AddHeader(HTTPGeneralHeaders::Date());
		parent::Header(HTTPEntityHeaders::Expires($mdata -> GetExpiration()));
		parent::AddHeader(HTTPEntityHeaders::Last-Modified($mdata -> GetModified()));
		parent::AddHeader(HTTPResponseHeaders::Server());
		if($_SERVER['SERVER_PROTOCOL'] !== 'HTTP/1.1')
			parent::AddHeader(HTTPGeneralHeaders::Upgrade());
	}
}

?>