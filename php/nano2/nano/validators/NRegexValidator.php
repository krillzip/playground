<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRegexValidator
 *
 * @author krillzip
 */
class NRegexValidator extends NValidator
{
    protected static $allowEmpty = true;
    
    protected static function doValidation($value, $options = array())
    {
        $regex = $options['regex'];
        return filter_var($value, FILTER_VALIDATE_REGEXP, $regex) !== false;
    }
}
?>
