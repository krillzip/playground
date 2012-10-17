<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NConfig
 *
 * @author krillzip
 */
class NConfig implements ArrayAccess, Countable, Iterator {

    protected $path = NULL;
    protected $data = array();

    public function __construct($arrayOrPath) {
        if (is_array($arrayOrPath)) {
            $this->data = $arrayOrPath;
            reset($this->data);
        } elseif (is_string($arrayOrPath)) {
            $this->path = $arrayOrPath;
            $this->load();
        } else {
            throw new NConfigException('Data array or path not given', NConfigException::ILLEGAL_DATA);
        }
    }

    public function load($path = NULL) {
        if (is_string($path)) {
            $this->path = $path;
        }

        if (file_exists($this->path) && is_readable($this->path)) {
            $this->data = include $this->path;
            reset($this->data);
        } else {
            throw new NConfigException('Path "' . $this->path . '" is illegal or file is not readable.', NConfigException::LOAD_FAILURE);
        }
    }

    public function save($path = NULL) {
        if (is_string($path)) {
            $this->path = $path;
        }

        $export = '<?php
            
return ' . var_export($this->data, true) . ';';
        if (file_put_contents($this->path, $export) === false) {
            throw new NConfigException('Failed to save data to "' . $this->path . '"', NConfigException::SAVE_FAILURE);
        }
    }

    public function count() {
        return count($this->data);
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value) {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    function rewind() {
        reset($this->data);
    }

    function current() {
        return current($this->data);
    }

    function key() {
        return key($this->data);
    }

    function next() {
        next($this->data);
    }

    function valid() {
        return current($this->data) === false ? false : true;
    }

}

class NConfigException extends Exception {

    const ILLEGAL_DATA = 1;
    const LOAD_FAILURE = 2;
    const SAVE_FAILURE = 3;

}