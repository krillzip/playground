<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NFloatValidator
 *
 * @author krillzip
 */
class NFloatValidator extends NValidator
{
    protected static $allowEmpty = true;
    
    protected static function doValidation($value, $options = array())
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) !== false;
    }
}
?>
