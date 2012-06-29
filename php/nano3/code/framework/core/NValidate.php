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
final class NValidate {
    public static function url($v){
        return filter_var(FILTER_VALIDATE_URL);
    }

    public static function email($v){
        return filter_var(FILTER_VALIDATE_EMAIL);
    }

    public static function ip($v){
        return filter_var(FILTER_VALIDATE_IP);
    }

    public static function int($v){
        return filter_var(FILTER_VALIDATE_INT);
    }

    public static function float($v){
        return filter_var(FILTER_VALIDATE_FLOAT);
    }
}
?>
