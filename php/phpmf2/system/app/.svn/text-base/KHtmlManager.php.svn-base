<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KHtmlManager
 *
 * @author krillzip
 */
class KHtmlManager extends KApplicationManager{
	const ENCODING_UTF8 = 'utf-8';

	private $title = 'Untitled document';
	private $favicon = NULL;
	private $description = NULL;
	private $keywords = array();

	private $layout = NULL;
	private $view = NULL;

	private $js = array();
	private $css = array();
    private $rss = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function setTitle($data)
    {
        $this->title = $data;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($data)
    {
        $this->description = $data;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setKeywords($data)
    {
        $this->keywords = $data;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

	public function favicon($href, $mime)
	{
		$this->favicon = array('href'=>$path, 'mime'=>$mime);
	}

    public function registerJS($src)
    {
        if(!in_array($src, $this->js))
            $this->js[] = $src;
    }

    public function registerCSS($href)
    {
        if(!in_array($href, $this->css))
            $this->css[] = $href;
    }

    public function registerRSS($href, $title)
    {
        if(!in_array($href, $this->rss))
            $this->rss[] = array('href'=>$href, 'title'=>$title);
    }

    public function setView($data)
    {
        $this->view = $data;
    }

    public function getView()
    {
        return $this->view;
    }

    public function setLayout($data)
    {
        $this->layout = $data;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function render(array $vars)
    {
		$impl = new DOMImplementation();
		$doctype = $impl->createDocumentType('html', '-//W3C//DTD XHTML 1.0 Strict//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd');
		$document = $impl->createDocument(null, 'html', $doctype);
        $document->preserveWhiteSpace = false;
		$document->xmlVersion = '1.0';
		$document->encoding = KHtmlManager::ENCODING_UTF8;

        $clip = KClip::clip();
        echo <<<XML
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled document</title>
</head>
<body>
XML;
        KDecorator::layout($this->layout, $this->view, $vars);
        echo <<<XML
</body>
</html>
XML;
        $document->loadXML($clip->flush());
        unset($clip);

        $head = $document->getElementsByTagName('head')->item(0);
        $title = $document->getElementsByTagName('title')->item(0);

		if(!empty($this->title))
            $title->nodeValue = $this->title;
		if(!empty($this->description))
		{
			$description = $document->createElement('meta');
			$description->setAttribute('name', 'decription');
			$description->setAttribute('content', $this->description);
			$head->appendChild($description);
		}
		if(!empty($this->keywords))
		{
			$keywords = $document->createElement('meta');
			$keywords->setAttribute('name', 'keywords');
			$keywords->setAttribute('content', $this->keywords);
			$head->appendChild($keywords);
		}

		if(!empty($this->favicon))
		{
			$favicon = $document->createElement('link');
			$favicon->setAttribute('rel', 'icon');
			$favicon->setAttribute('type', $this->favicon['mime']);
			$favicon->setAttribute('href', $this->favicon['href']);
			$head->appendChild($favicon);
		}

		if(!empty($this->css)) foreach($this->css as $css)
        {
			$stylesheet = $document->createElement('link');
			$stylesheet->setAttribute('rel', 'stylesheet');
			$stylesheet->setAttribute('type', 'text/css');
			$stylesheet->setAttribute('href', $css);
			$head->appendChild($stylesheet);
        }

		if(!empty($this->rss)) foreach($this->rss as $rss)
        {
			$feed = $document->createElement('link');
			$stylesheet->setAttribute('rel', 'alternate');
			$stylesheet->setAttribute('type', 'application/rss+xml');
            $stylesheet->setAttribute('title', $rss['title']);
			$stylesheet->setAttribute('href', $rss['href']);
			$head->appendChild($stylesheet);
        }

		if(!empty($this->js)) foreach($this->js as $js)
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