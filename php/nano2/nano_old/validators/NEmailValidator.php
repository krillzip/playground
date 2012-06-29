<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NEmailValidator
 *
 * @author krillzip
 */
class NEmailValidator extends NValidator
{
    protected static $allowEmpty = true;
    
    protected static function doValidation($value, $options = array())
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }
}
?>