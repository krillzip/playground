<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once SYS_PATH . DS . 'helpers' . DS . 'NConfig.php';
require_once SYS_PATH . DS . 'helpers' . DS . 'NAutoloader.php';

/**
 * Description of NSys
 *
 * @author krillzip
 */
class NSys {

    protected static $appInstance;

    public static function initialize() {
        // Setting up autoloader.
        $configPath = APP_PATH . DS . 'runtime' . DS . 'classes.php';
        try {
            $classes = new NConfig($configPath);
        } catch (NConfigException $e) {
            if ($e->getCode() == NConfigException::LOAD_FAILURE) {
                $classes = NAutoloader::indexClasses();
                //$save = new NConfig($classes);
                //$save->save($configPath);
            } else {
                echo $e->getTraceAsString();
            }
        }
        NAutoloader::initialize($classes);

        // Setting up application class.
        self::$appInstance = new NApplication();
        NUtil::configureComponent(new NConfig(APP_PATH . DS . 'config' . DS . 'main.php'), self::$appInstance);
        self::$appInstance->init();
    }

    public static function finalize() {
        
    }

    public static function app() {
        return self::$appInstance;
    }

}
