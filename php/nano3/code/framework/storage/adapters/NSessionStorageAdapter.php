<?php

class NSessionStorageAdapter extends NStorageAdapterBase {
    protected function init(array $config = array()) {
        if(isset($_SESSION[$this->_alias]))
            $this->_value = $_SESSION[$this->_alias];
    }

    protected function finalize() {
        if(empty($this->_alias))
            unset($_SESSION[$this->_alias]);
        else
            $_SESSION[$this->_alias] = $this->_values;
    }

    public function set($key, $value, $expires = null) {
        $this->_values[$key] = $value;
    }

    public function get($key) {
        return $this->_values[$key];
    }

    public function flush() {
        $this->_values = array();
    }

    public function all() {
        return $this->_values;
    }

    public function exists($key) {
        return isset($this->_values[$key]);
    }

    public function delete($key) {
        unset($this->_values[$key]);
    }
}