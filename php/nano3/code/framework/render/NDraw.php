<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDraw
 *
 * @author krillzip
 */
class NDraw {
    private $_data = array();

    public function __construct($alias, array $vars = array()) {
        $this->_data = $vars;
        $this->sanetize();
        $this->process(NAlias::resolve($alias, '.view.php'));
    }

    protected function sanetize() {
        unset($this->_data['_GET']);
        unset($this->_data['_POST']);
        unset($this->_data['_REQUEST']);
        unset($this->_data['_SERVER']);
        unset($this->_data['_COOKIE']);
        unset($this->_data['_FILES']);
        unset($this->_data['_ENV']);
        unset($this->_data['_SESSION']);
        unset($this->_data['_path_']);
    }

    protected function process($_path_) {
        extract($this->_data);
        include($_path_);
    }

    public static function render($alias, array $vars = array()) {
        $view = new NDraw($alias, $vars);
        unset($view);
    }

    public static function draw($alias, array $vars = array()) {
        $clip = NClip::clip();
        NDraw::render($alias, $vars);
        $clip->end();
        return $clip;
    }
}