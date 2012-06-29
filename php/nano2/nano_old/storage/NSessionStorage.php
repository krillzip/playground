<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MSessionStorage
 *
 * @author krillzip
 */
class NSessionStorage extends NDataStorage{
    protected $_namespaces = array();
    
    public abstract function __construct()
    {
        session_start();
    }

    public function synchronize(array $data, $namespace)
    {
        foreach($data as $key=>$value)
            $this->set($key, $value, NULL, $namespace);
    }

    public function get($name, $namespace)
    {
        if($_SESSION[$namespace][$name]['date'] > time())
            return $_SESSION[$namespace]['value'];
        else
            unset($_SESSION[$namespace][$name]);
    }

    public function set($name, $value, $expire, $namespace)
    {
        if(is_null($expire))
            $expire = $_SESSION[$namespace][$name]['date'];
        $_SESSION[$namespace][$name] = array(
            'date'=>$expire,
            'value'=>$value
        );
    }

    public function add($name, $value, $namespace)
    {
        $_SESSION[$namespace][$name] = array(
            'date'=>NULL,
            'value'=>$value
        );
    }

    public function delete($name, $namespace)
    {
        unset($_SESSION[$namespace][$name]);
    }

    public function flush($namespace)
    {
        unset($_SESSION[$namespace]);
    }

    public function namespace($namespace, $synchronized = false)
    {
        if(!isset($this->_namespaces[$namespace]))
        {
            $nsdata = array();
            foreach($_SESSION[$namespace] as $key=>$value)
                $nsdata[$key] = $_SESSION[$namespace][$key]['value'];
            $this->_namespaces[$namespace] = new NDataNameSpace($this, $nsdata, $namespace, $synchronized);
        }
        return $this->_namespaces[$namespace];
    }
}
?>