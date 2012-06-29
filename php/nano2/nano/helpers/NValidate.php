<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NValidate
 *
 * @author krillzip
 */
class NValidate {
    private $_validators = array();
    private function __construct()
    {
        $this->_validators = NFramework::import('nano.config.validators');
    }
    private static $_instance = NULL;
    private function __clone(){throw new Exception();}
    protected static function instance() {
        $class = __CLASS__;
        if(self::$_instance == NULL)
        self::$_instance = new $class();
        return self::$_instance;
    }

    public static function validate($value, $try, $options = array())
    {
        if(isset($this->_validators[$try]))
        {
            Nano::import($this->_validators[$try]);
            $class = NFramework::klass($this->_validators[$try]);
        }
        else
        {
            Nano::import($try);
            $class = NFramework::klass($try);
        }
        return NFramework::invoke($class, 'validate', array('value'=>$value, 'options'=>$options));
    }
}
?>