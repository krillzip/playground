<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IDataObject
 *
 * @author krillzip
 */
interface IDataObject {
    public function __get($name);
    public function __set($name, $value);
    public function __isset($name);
    public function __unset($name);
}
?>
