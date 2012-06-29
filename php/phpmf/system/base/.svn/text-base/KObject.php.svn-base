<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KObject
 *
 * @author krillzip
 */
abstract class KObject {
    public function __set($name, $value)
    {
        return $this->setter($name, $value);
    }

    public function __get($name)
    {
        return $this->getter($name);
    }

    protected function setter($name, $value)
    {
        $setter = 'set'.ucfirst($name);
        if(method_exists($this, $setter))
            $this->$setter($value);
    }

    protected function getter($name)
    {
        $getter = 'get'.ucfirst($name);
        if(method_exists($this, $getter))
            return $this->$getter($name);
        else
            return NULL;
    }
}
?>