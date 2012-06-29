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
class KDataObject extends KObject implements IDataObject{
    protected $_data = array();

    public function __construct(){}

    public function __get($name)
    {
        return $this->_data[$name];
    }

    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    public function __unset($name)
    {
        unset($this->_data[$name]);
    }

    protected function merge(array $first, array $second)
    {
        return array_merge($first, $second);
    }
}
?>
