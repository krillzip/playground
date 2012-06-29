<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(dirname(__FILE__).'View.php');
require_once(dirname(__FILE__).'Clip.php');
 
/**
 * Description of NXhtmlRender
 *  A renderer that outputs XHTML.
 * @author krillzip
 */
class XhtmlRender{
    const ENCODING_UTF8 = 'utf-8';

    private $_params;
    private $_view;
    private $_assets;
	
	public $title = '';
	public $keywords = '';
	public $description = '';

    public function __construct($view, array $params = NULL)
    {
        $this->view = $view;
        $this->_params = $options;
    }

	public function regJavaScript($js)
	{
		$this->_assets['js'][] = $js;
	}
	
	public function regStyleSheet($css)
	{
		$this->_assets['css'][] = $css;
	}
	
	public function regFavicon($mime, $href)
	{
		$this->_assets['favicon'] = array('href'=>$href, 'mime'=>$mime);
	}
	
	public function regRSS($title, $href)
	{
		$this->_assets['rss'] = array('href'=>$href, 'title'=>$title);
	}
	
    public function render()
    {
        $impl = new DOMImplementation();
        $doctype = $impl->createDocumentType('html', '-//W3C//DTD XHTML 1.0 Strict//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd');
        $document = $impl->createDocument(null, 'html', $doctype);
        $document->preserveWhiteSpace = false;
        $document->xmlVersion = '1.0';
        $document->encoding = XhtmlRender::ENCODING_UTF8;

        $clip = Clip::clip();
        echo <<<XML
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<title>Untitled document</title>
</head>
<body>
XML;
        View::render($this->_view, $this->_params);
        echo <<<XML
</body>
</html>
XML;
        $document->loadXML($clip->flush());
        unset($clip);

        $head = $document->getElementsByTagName('head')->item(0);
        $title = $document->getElementsByTagName('title')->item(0);

		// Set title
        if(!empty($this->title) && is_string($this->title))
            $title->nodeValue = $this->title);
			
		// Set description
        if(!empty($this->description) && is_string($this->description))
        {
            $description = $document->createElement('meta');
            $description->setAttribute('name', 'decription');
            $description->setAttribute('content', $this->description);
            $head->appendChild($description);
        }
		
		// Set keywords
        if(!empty($this->keywords) && is_string($this->keywords))
        {
            $keywords = $document->createElement('meta');
            $keywords->setAttribute('name', 'keywords');
            $keywords->setAttribute('content', $this->keywords);
            $head->appendChild($keywords);
        }

		// Set favicon
        if(!empty($this->_assets['favicon']))
        {
            $farr = $this->_assets['favicon'];
            $favicon = $document->createElement('link');
            $favicon->setAttribute('rel', 'icon');
            $favicon->setAttribute('mime', $farr['mime']);
            $favicon->setAttribute('href', $farr['href']);
            $head->appendChild($favicon);
        }

		// Set css files
        if(!empty($this->_assets['css'])) foreach($this->_assets['css'] as $css)
        {
            $stylesheet = $document->createElement('link');
            $stylesheet->setAttribute('rel', 'stylesheet');
            $stylesheet->setAttribute('type', 'text/css');
            $stylesheet->setAttribute('href', $css);
            $head->appendChild($stylesheet);
        }

		// Set RSS feeds
        if(!empty($this->_assets['rss'])) foreach($this->_assets['rss'] as $rss)
        {
            $feed = $document->createElement('link');
            $stylesheet->setAttribute('rel', 'alternate');
            $stylesheet->setAttribute('type', 'application/rss+xml');
            $stylesheet->setAttribute('title', $rss['title']);
            $stylesheet->setAttribute('href', $rss['href']);
            $head->appendChild($stylesheet);
        }

		// Sets Javascripts
        if(!empty($this->_assets['js'])) foreach($this->_assets['js'] as $js)
        {
            $javascript = $document->createElement('script');
            $javascript->setAttribute('type', 'text/javascript');
            $javascript->setAttribute('src', $js);
            $head->appendChild($javascript);
        }

        $document->formatOutput = true;
        $document->normalizeDocument();
        echo $document->saveXML();
    }
}
?>