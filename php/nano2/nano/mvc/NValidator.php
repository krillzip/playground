<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NValidator
 *
 * @author krillzip
 */
abstract class NValidator
{
    public final static function validate($value, $options = array())
    {
        if(isset(self::$allowEmpty) && strlen((string)$value) == 0)
            return true;
        else
            return self::doValidation($value, $options);
    }

    protected abstract static function doValidation($value, array $options);
}

?>