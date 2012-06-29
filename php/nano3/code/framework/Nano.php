<?php

/**
 * Reporting strict all errors.
 */
error_reporting(E_ALL | E_STRICT);

/**
 * Application wide defines.
 */

if(!defined(PRODUCTION)) {
    define(PRODUCTION, true);
}

if(!defined(DS)) {
    define(DS, DIRECTORY_SEPARATOR);
}

if(!defined(WEBROOT)) {
    define(WEBROOT, dirname(__FILE__));
}

if(!defined(NANO_PATH)) {
    define(NANO_PATH, dirname(dirname(__FILE__)).DS.'framework');
}

if(!defined(APP_PATH)) {
    define(APP_PATH, dirname(dirname(__FILE__)).DS.'application');
}

if(!defined(VENDORS_PATH)) {
    define(VENDORS_PATH, dirname(dirname(__FILE__)).DS.'vendors');
}

/**
 * Nano exception
 */

class NException extends Exception {}

/**
 * Nano object base-class
 */
class NObject {
    public function __set($name, $value) {
        return $this->setter($name, $value);
    }

    public function __get($name) {
        return $this->getter($name);
    }

    protected function setter($name, $value) {
        $setter = 'set'.ucfirst($name);
        if(method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }

    protected function getter($name) {
        $getter = 'get'.ucfirst($name);
        if(method_exists($this, $getter)) {
            return $this->$getter($name);
        }
        else {
            return NULL;
        }
    }
}

/**
 * Loading som minimal required classes.
 */
require_once(dirname(__FILE__).DS.'core'.DS.'NAlias.php');
require_once(dirname(__FILE__).DS.'core'.DS.'NConfig.php');
require_once(dirname(__FILE__).DS.'core'.DS.'NFacade.php');
require_once(dirname(__FILE__).DS.'core'.DS.'IHook.php');
require_once(dirname(__FILE__).DS.'core'.DS.'IEventListener.php');

/**
 * Description of Nano
 *  The main wrapper.
 * @author krillzip
 */
final class Nano {
    private static $_facade = NULL;
    private static $_classes = array();
    private static $_hooks = array();
    private static $_listeners = array();

    /**
     * Initializes the Nano framework
     */
    public static function init() {
    // Setting up sessions
        session_start();

        // Setting up autoloading
        self::$_classes = NConfig::merge(NConfig::import('nano.config.classes'), NConfig::import('app.config.classes', true));
        spl_autoload_register(array(__CLASS__,'autoload'));

        // Loading and executing hooks
        self::$_hooks = NConfig::merge(NConfig::import('nano.config.hooks'), NConfig::import('app.config.hooks', true));
        foreach(self::$_hooks as $alias) {
            Nano::import($hook);
            $hclass = NAlias::klass($hook);
            if(is_subclass_of($hclass, 'IHook')) {
                call_user_func(array($hclass, 'executeHook'));
            }
        }
    }

    /**
     *  The global autoload function of the wrapper.
     * @param <string> $class Name of class to load
     * @return <bool> true or false if class was loaded successfully
     */
    public static function autoload($class) {
        if (class_exists($class)) {
            return true;
        }

        if(array_key_exists($class, self::$_classes)) {
            $load = NAlias::resolve(self::$_classes[$class]);
            if(file_exists($load)) {
                include($load);
                return true;
            }
        }
        return false;
    }

    /**
     *  Adds an alias classpath to be used by the autoloader.
     * @param <type> $alias The alias of the class to import.
     */
    public static function import($alias) {
        if(is_string($alias)) {
            self::$_classes[NAlias::klass($alias)] = $alias;
        }
    }

    /**
     *  Returns alias path of registered class.
     * @param <string> $class Name of class
     * @return <string> Alias of class
     */
    public static function alias($class) {
        return self::$classes[$class];
    }

    /**
     *  Returns the global facade singleton object.
     * @return <type> The facade instance
     */
    public static function f() {
        if(!self::$_facade) {
            $config = NConfig::import('app.config.config', true);
            if(empty($config)) {
                $config = NConfig::import('nano.config.config');
            }
            self::$_facade = new NFacade($config);
        }
        return self::$_facade;
    }

    public static function addListener(IEventListener $listener, $event) {
        self::$_listeners[$event][] = $listener;
    }

    public static function raiseEvent($event) {
        if(isset(self::$_listeners[$event])) {
            foreach(self::$_listeners[$event] as $handler) {
                $handler->handleEvent($event);
            }
        }
    }
}