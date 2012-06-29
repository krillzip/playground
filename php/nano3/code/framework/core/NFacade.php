<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NFacade
 *
 * @author krillzip
 */
class NFacade {
    protected $_instances = array();
    protected $_config = array();
    protected $_services = array(
    'router'=>'NRouter',
    'ua'=>'NUserAgent',
    'db'=>'NDatabase',
    'storage'=>'NStorage',
    'html'=>'NHtml',
    );

    public function __construct(array $config) {
        $this->_config = $config;
    }

    public function __get($name) {
        if(!isset($this->_services[$name])) {
            throw new NFacadeException('The NFacade class doesn\'t support service '.$name);
        }
        if(!isset($this->_instances[$name])) {
            $class = $this->_services[$name];
            Nano::autoload($class);
            $args = isset($this->_config[$name]);
            $this->_instances[$name] = new $class($args?$this->_config[$name]:array());
        }
        return $this->_instances[$name];
    }
}

class NFacadeException extends NException {}