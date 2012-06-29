<?php

require_once(VENDORS_PATH.DS.'Outlet'.DS.'Outlet.php');

class NDatabase extends Outlet {

    public static function autoload($class) {
        $config = Nano::f()->db->getConfig();
        if(!empty($config['classes'][$class])) {
            eval('class '.$class.' extends NDynamicActiveRecord{
				public function __construct(){
					parent::__construct('.var_export($config['classes'][$class], true).');
				}
			}');
            return true;
        }
        else {
            return false;
        }
    }
}

spl_autoload_register(array(__CLASS__,'autoload'));