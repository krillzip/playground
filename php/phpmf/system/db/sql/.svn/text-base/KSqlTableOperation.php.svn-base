<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KSqlTableOperation
 *
 * @author krillzip
 */
abstract class KSqlTableOperation extends KObject{
    protected $data;
    public function __construct()
    {
        
    }
    public function __get($name)
    {
        if(isset($this->data[$name]))
            return $this->data[$name];
        else
            return parent::__get($name);
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public abstract function sql();
}
?>