<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NXhtmlRender
 *  A renderer that outputs XHTML.
 * @author krillzip
 */
class NXhtmlRender extends NRender{
    const ENCODING_UTF8 = 'utf-8';
    private $_params;
    private $_options;
    private $_assets;

    public function __construct(array $params, array $options = NULL)
    {
        $this->_params = $params;
        $this->_options = $options;
        $this->_assets = Nano::app()->assets->assets;
    }

    public function render()
    {
        $impl = new DOMImplementation();
        $doctype = $impl->createDocumentType('html', '-//W3C//DTD XHTML 1.0 Strict//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd');
        $document = $impl->createDocument(null, 'html', $doctype);
        $document->preserveWhiteSpace = false;
        $document->xmlVersion = '1.0';
        $document->encoding = NXhtmlRender::ENCODING_UTF8;

        $clip = NClip::clip();
        echo <<<XML
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<title>Untitled document</title>
</head>
<body>
XML;
        NView::render($this->_options['view'], $this->_params);
        echo <<<XML
</body>
</html>
XML;
        $document->loadXML($clip->flush());
        unset($clip);

        $head = $document->getElementsByTagName('head')->item(0);
        $title = $document->getElementsByTagName('title')->item(0);

        if(!empty($this->_assets['title']))
            $title->nodeValue = array_shift($this->_assets['title']);
        if(!empty($this->_assets['description']))
        {
            $description = $document->createElement('meta');
            $description->setAttribute('name', 'decription');
            $description->setAttribute('content', implode(', ', $this->_assets['description']));
            $head->appendChild($description);
        }
        if(!empty($this->_assets['keywords']))
        {
            $keywords = $document->createElement('meta');
            $keywords->setAttribute('name', 'keywords');
            $keywords->setAttribute('content', implode(', ', $this->_assets['keywords']));
            $head->appendChild($keywords);
        }

        if(!empty($this->_assets['favicon']))
        {
            $farr = array_shift($this->_assets['favicon']);
            $favicon = $document->createElement('link');
            $favicon->setAttribute('rel', 'icon');
            $favicon->setAttribute('type', $farr['mime']);
            $favicon->setAttribute('href', $farr['href']);
            $head->appendChild($favicon);
        }

        if(!empty($this->_assets['css'])) foreach($this->_assets['css'] as $css)
        {
            $stylesheet = $document->createElement('link');
            $stylesheet->setAttribute('rel', 'stylesheet');
            $stylesheet->setAttribute('type', 'text/css');
            $stylesheet->setAttribute('href', $css);
            $head->appendChild($stylesheet);
        }

        if(!empty($this->_assets['rss'])) foreach($this->_assets['rss'] as $rss)
        {
            $feed = $document->createElement('link');
            $stylesheet->setAttribute('rel', 'alternate');
            $stylesheet->setAttribute('type', 'application/rss+xml');
            $stylesheet->setAttribute('title', $rss['title']);
            $stylesheet->setAttribute('href', $rss['href']);
            $head->appendChild($stylesheet);
        }

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