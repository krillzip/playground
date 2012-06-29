<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NUrlValidator
 *
 * @author krillzip
 */
class NUrlValidator extends NValidator
{
    protected static $allowEmpty = true;
    
    protected static function doValidation($value, $options = array())
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}
?>
