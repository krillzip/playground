<?php

class NFileStorageAdapter extends NStorageAdapterBase {
    protected $_md5;
    protected $_changed = false;
    protected $_path;

    protected function init(array $config = array()) {
        $this->_md5 = md5($this->_alias);
        $this->_path = $config['path'].'.'.$this->_md5;
        if(NAlias::real($this->_path))
            $this->_values = NConfig::import($this->_path);
    }

    protected function finalize() {
        if($this->_changed && !empty($this->_values))
            NConfig::export($this->_path, $this->_values);
    }

    public function set($key, $value, $expires = null) {
        $this->_values[$key] = $value;
        $this->_changed = true;
    }

    public function get($key) {
        return $this->_values[$key];
    }

    public function flush() {
        $this->_values = array();
        $path = NAlias::resolve($this->_path);
        unset($path);
        $this->_changed = true;
    }

    public function all() {
        return $this->_values;
    }

    public function exists($key) {
        return isset($this->_values[$key]);
    }

    public function delete($key) {
        unset($this->_values[$key]);
        $this->_changed = true;
    }
}