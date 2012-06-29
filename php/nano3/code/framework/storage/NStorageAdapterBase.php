<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NStorageAdapterBase
 *
 * @author krillzip
 */
abstract class NStorageAdapterBase implements IStorageAdapter {
    protected $_alias;
    protected $_values = array();
    protected $_config;

    public function __construct($alias, array $config = array()) {
        $this->_alias = $alias;
        $this->_config = $config;
        $this->init($this->_config);
    }

    public function __destruct() {
        $this->finalize();
    }

    protected function finalize() {
    }

    abstract protected function init(array $config = array());

    public function __set  ($name, $value) {
        $this->set($name, $value);
    }

    public function __get($name) {
        return $this->get($name);
    }

    public function __isset($name) {
        return $this->exists($name);
    }

    public function __unset($name) {
        $this->delete($name);
    }
}
