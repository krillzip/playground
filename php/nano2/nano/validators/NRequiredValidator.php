<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRequiredValidator
 *
 * @author krillzip
 */
class NRequiredValidator extends NValidator
{   
    protected static function doValidation($value, $options = array())
    {
        return (!empty($value) || is_int($value) || is_bool($value));
    }
}
?>