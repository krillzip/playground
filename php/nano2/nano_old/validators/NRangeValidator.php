<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRangeValidator
 *
 * @author krillzip
 */
class NRangeValidator extends NValidator
{
    protected static $allowEmpty = true;
    
    protected static function doValidation($value, $options = array())
    {
        return ($value >= $options[0] && $value <= $options[1]);
    }
}
?>