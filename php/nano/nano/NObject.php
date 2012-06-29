<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NObject
 * The most basic object a class can consist of.
 * @author krillzip
 */
class NObject {
    public function __set($name, $value)
    {
        $setter = 'set'.ucfirst($name);
        if(method_exists($this, $setter))
            $this->$setter($value);
        else
            $this->setter($name, $value);
    }

    public function __get($name)
    {
        $getter = 'get'.ucfirst($name);
        if(method_exists($this, $getter))
            return $this->$getter($name);
        else
            return $this->getter($name);
    }

    protected function setter($name, $value)
    {

    }

    protected function getter($name)
    {
        return NULL;
    }
}
?>
