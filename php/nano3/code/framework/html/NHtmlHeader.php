<?php

class NHtmlHeader extends NObject {
// Values
    protected $_title;
    protected $_base;
    protected $_favicon;
    protected $_language;
    protected $_direction;

    // Meta
    protected $_author;
    protected $_subject;
    protected $_description;
    protected $_keywords;
    protected $_generator;
    protected $_expires;
    protected $_abstract;
    protected $_copyright;
    protected $_designer;
    protected $_publisher;
    protected $_distribution;
    protected $_robots;

    // Assets
    protected $_rss = array();
    protected $_js = array();
    protected $_css = array();

    public function __construct(array $config = array()) {
        $this->_title = $config['title'];
        $this->_base = $config['base'];
        $this->_favicon = $config['favicon'];
        $this->_language = $config['language'];
        $this->_direction = $config['direction'];

        $this->_author = $config['meta']['author'];
        $this->_author = $config['meta']['subject'];
        $this->_author = $config['meta']['description'];
        $this->_author = $config['meta']['keywords'];
        $this->_author = $config['meta']['generator'];
        $this->_author = $config['meta']['expires'];
        $this->_author = $config['meta']['abstract'];
        $this->_author = $config['meta']['copyright'];
        $this->_author = $config['meta']['designer'];
        $this->_author = $config['meta']['publisher'];
        $this->_author = $config['meta']['distribution'];
        $this->_author = $config['meta']['robots'];
    }

    public function addRss($href, $title) {
        $rss = new StdClass();
        $rss->href = $href;
        $rss->title = $title;
        $this->_rss[] = $rss;
    }

    public function addCss($href, $media = 'screen') {
        $css = new StdClass();
        $css->href = $href;
        $css->media = $media;
        $this->_css[] = $css;
    }

    public function addJs($src) {
        $js = new StdClass();
        $js->src = $src;
        $this->_js[] = $js;
    }

    public function getTitle() {
        return $this->_title;
    }

    public function  setTitle($v) {
        $this->_title = $v;
    }

    public function getDirection() {
        return $this->_direction;
    }

    public function  setDirection($v) {
        $this->_direction = $v;
    }

    public function getBase() {
        return $this->_base;
    }

    public function  setBase($v) {
        $this->_base = $v;
    }

    public function getSubject() {
        return $this->_subject;
    }

    public function  setSubject($v) {
        $this->_subject = $v;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function  setDescription($v) {
        $this->_description = $v;
    }

    public function getKeywords() {
        return $this->_keywords;
    }

    public function  setKeywords($v) {
        $this->_keywords = $v;
    }

    public function getGenerator() {
        return $this->_generator;
    }

    public function  setGenerator($v) {
        $this->_generator = $v;
    }

    public function getLanguage() {
        return $this->_language;
    }

    public function  setLanguage($v) {
        $this->_language = $v;
    }

    public function getExpires() {
        return $this->_expires;
    }

    public function  setExpires($v) {
        $this->_expires = $v;
    }

    public function getAbstract() {
        return $this->_abstract;
    }

    public function  setAbstract($v) {
        $this->_abstract = $v;
    }

    public function getCopyright() {
        return $this->_copyright;
    }

    public function  setCopyright($v) {
        $this->_copyright = $v;
    }

    public function getDesigner() {
        return $this->_designer;
    }

    public function  setDesigner($v) {
        $this->_designer = $v;
    }

    public function getPublisher() {
        return $this->_publisher;
    }

    public function  setPublisher($v) {
        $this->_publisher = $v;
    }

    public function getDistribution() {
        return $this->_distribution;
    }

    public function  setDistribution($v) {
        $this->_distribution = $v;
    }

    public function getRobots() {
        return $this->_robots;
    }

    public function  setRobots($v) {
        $this->_robots = $v;
    }

    public function getHeader() {
        return array(
        'title'=>$this->_title,
        'base'=>$this->_base,
        'language'=>$this->_language,
        'direction'=>$this->_direction,
        'favicon'=>$this->_favicon,
        'meta'=>$this->metaObject(),
        'assets'=>$this->assetsObject(),
        );
    }

    protected function metaObject() {
        $meta = new StdClass();

        $meta->author = $this->_author;
        $meta->subject = $this->_subject;
        $meta->description = $this->_description;
        $meta->keywords = $this->_keywords;
        $meta->generator = $this->_generator;
        $meta->expires = $this->_expires;
        $meta->abstract = $this->_abstract;
        $meta->copyright = $this->_copyright;
        $meta->designer = $this->_designer;
        $meta->publisher = $this->_publisher;
        $meta->distribution = $this->_distribution;
        $meta->robots = $this->_robots;

        return $meta;
    }

    protected function assetsObject() {
        $assets = new StdClass();

        $assets->rss = $this->_rss;
        $assets->js = $this->_js;
        $assets->css = $this->_css;

        return $assets;
    }
}