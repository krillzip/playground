<?php

class NCookieStorageAdapter extends NStorageAdapterBase {
    protected function init(array $config = array()) {

    }

    protected function finalize() {

    }

    protected function realKey($key) {
        return $this->_alias.':'.$key;
    }

    public function set($key, $value, $expires = null) {
        $key = $this->realKey($key);
        setcookie($key, $value, $expires?0:$expires);
        $_COOKIE[$key] = $value;
    }

    public function get($key) {
        return $_COOKIE[$this->realKey($key)];
    }

    public function flush() {
    }

    public function all() {
    }

    public function exists($key) {
        return isset($_COOKIE[$this->realKey($key)]);
    }

    public function delete($key) {
        $key = $this->realKey($key);
        setcookie($key, '', time() - 3600);
        unset($_COOKIE[$key]);
    }
}