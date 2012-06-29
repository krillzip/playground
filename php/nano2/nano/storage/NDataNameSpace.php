<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDataNameSpace
 *
 * @author krillzip
 */
class NDataNameSpace extends NObject{
    protected $_storage;
    protected $_synch;
    protected $_namespace;

    protected $_data = array();
    protected $_updated = array();
    
    public function __construct(NDataStorage $storage, array $data, $namespace, $synchronized = false)
    {
        $this->_storage = $storage;
        $this->_namespace = $namespace;
        $this->_synch = $synchronized;
        $this->_data = $data;
    }

    public function __destruct()
    {
        if($this->_synch)
            $this->synchronize();
    }

    public function synchronize()
    {
        $update = array();
        foreach($this->_updated as $key=>$value)
            $update[$key] = $this->_data[$key];
        $this->_storage->synchronize($this->_data, $this->_namespace);
    }

    protected function getter($name)
    {
        return $this->_data[$name];
    }

    protected function setter($name, $value)
    {
        $this->set($name, $value);
    }

    public function get($name)
    {
        return $this->_storage->get($name, $this->_namespace);
    }

    public function set($name, $value, $expire = NULL)
    {
        $this->_storage->set($name, $value, $expire, $this->_namespace);
        $this->_data[$name] = $value;
    }
    public function add($name, $value)
    {
        $this->_storage->set($name, $value, $this->_namespace);
        $this->_data[$name] = $value;
    }

    public function delete($name)
    {
        $this->_storage->delete($name, $this->_namespace);
        unset($this->_data[$name]);
    }
}
?>