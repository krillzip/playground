<?php

class NHtmlLayout extends NObject {
    protected $_config = array();

    public function __construct(array $config = array()) {
        $this->_config = $config;
    }

    public function container($c) {
        if(!empty($this->_config[$c]) && is_array($this->_config[$c])) {
            $container = $this->_config[$c];
            foreach($container as $alias => $config) {
                echo NDraw::render($alias, $config);
            }
        }
    }
}