<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDataObject
 *
 * @author krillzip
 */
abstract class KAccessDataObject extends KObject implements IDataObject{
    protected $_data = array();
    protected $_access = array();

    public function __construct()
    {
        $this->_access = $this->access;
    }

    public function __get($name)
    {
        if(stripos($this->_access[$name], 'r') !== false)
            return $this->_data[$name];
        else
            return parent::getter($name);
    }

    public function __set($name, $value)
    {
        if(stripos($this->_access[$name], 'w') !== false)
            $this->_data[$name] = $value;
        else
            parent::setter($name, $value);
    }

    public function __isset($name)
    {
        return isset($this->_access[$name], $this->_data[$name]);
    }

    public function __unset($name)
    {
        if(stripos($this->_access[$name], 'w') !== false);
            unset($this->_data[$name]);
    }

    protected abstract function access();
}
?>