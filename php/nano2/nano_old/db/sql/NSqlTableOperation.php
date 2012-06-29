<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KSqlTableOperation
 * Base class for classes that describes database table operations.
 *
 * @author krillzip
 */
abstract class NSqlTableOperation extends NObject{
    protected $_data;
    public function __construct()
    {
        
    }
    public function __get($name)
    {
        if(isset($this->_data[$name]))
            return $this->_data[$name];
        else
            return parent::__get($name);
    }

    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    public abstract function sql();

    public function __toString()
    {
        return $this->sql();
    }
}
?>