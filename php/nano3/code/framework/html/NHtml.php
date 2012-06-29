<?php

class NHtml extends NObject {
    const STRICT = 'xhtml-strict';
    const TRANSITIONAL = 'xhtml-transitional';

    // Header variables
    protected $_header;
    protected $_assets;
    protected $_standard;

    protected $_layout;
    protected $_containers = array();

    protected $_content = array();
    protected $_view;

    protected $_config;

    public function __construct(array $config = array()) {
        $this->_config = $config;
        $this->_standard = 'nano.views.'.NHtml::TRANSITIONAL;
        $this->_header = new NHtmlHeader((isset($config['header'])?$config['header']:array()));
        $this->_assets = new NHtmlAssets();

        if(isset($config['resources'])) {
            $this->addResources($config['resources']);
        }
    }

    public function addResources(array $rez) {
        foreach($rez as $type => $resources) {
            foreach($resources as $res) {
                switch($type) {
                    case 'rss':
                        $this->_header->addRss($res['href'], $res['title']);
                        break;
                    case 'js':
                        if(NValidate::url($res)) {
                            $this->_header->addJs($res);
                        }
                        else {
                            $path = $this->_assets->addJs($res);
                            $this->_header->addJs($path);
                        }
                        break;
                    case 'css':
                        $path = $this->_assets->addCss($res['alias']);
                        $this->_header->addCss($path, $res['media']);
                        break;
                    default:
                        break;
                }
            }
        }
    }

    /**
     *  Renders HTML document
     */
    public function render() {
    // Render content
        $content = NDraw::draw($this->_view, $this->_content);

        // Render layout
        $layout = NDraw::draw($this->_layout, array('layout'=>new NHtmlLayout($this->_containers), 'content'=>$content));

        // Render document
        $args = NConfig::merge($this->_header->getHeader(), array('content'=>$layout));
        NDraw::render($this->_standard, $args);
    }

    /**
     *  Sets the alias containing the template of the standard.
     * @param <type> $alias
     */
    public function setStandard($alias) {
        $this->_standard = 'nano.views.'.$alias;
    }

    /**
     *  Returns the template path of the current standard.
     * @return <type>
     */
    public function getStandard() {
        return $this->_standard;
    }

    /**
     *  Returns the instance of the NHtmlHeader.
     * @return <type>
     */
    public function getHeader() {
        return $this->_header;
    }

    /**
     *  Sets the container configuration.
     * @param <type> $config
     */
    public function setContainers($config) {
        $this->_containers = $config;
    }

    /**
     *  Returns the container configuration.
     * @return <type>
     */
    public function getContainers() {
        return $this->_containers;
    }

    /**
     *  Sets the path of the layout template
     * @param <type> $alias
     */
    public function setLayout($alias) {
        $this->_layout = $alias;
    }

    /**
     *  Returns the alias path of the layout
     * @return <type>
     */
    public function getLayout() {
        return $this->_layout;
    }

    /**
     *  Sets the data tp be used at content generation.
     * @param <type> $config
     */
    public function setContent($config) {
        $this->_content = $config;
    }

    /**
     *  Returns the content data.
     * @return <type>
     */
    public function getContent() {
        return $this->_content;
    }

    /**
     *  Setting the alias of view to use for content generation.
     * @param <type> $alias
     */
    public function setView($alias) {
        $this->_view = $alias;
    }

    /**
     *  Get alias of the current view for content generation.
     * @return <type>
     */
    public function getView() {
        return $this->_view;
    }
}