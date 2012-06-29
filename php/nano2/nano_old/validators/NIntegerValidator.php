<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NIntegerValidator
 *
 * @author krillzip
 */
class NIntegerValidator extends NValidator
{
    protected static $allowEmpty = true;
    
    protected static function doValidation($value, $options = array())
    {
        return filter_var($value, FILTER_VALIDATE_INTEGER) !== false;
    }
}
?>