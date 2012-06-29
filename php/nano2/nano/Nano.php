<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Nano
 * is the System class of the framework, doing the most core stuff, like initialize.
 *
 * @author krillzip
 */

require_once(dirname(__FILE__).DS.'helpers'.DS.'NFramework.php');

class Nano {
    private static $initialized = false;
    private static $executed = false;
    
    private static $classes = array();
    private static $application = NULL;

    /**
     * Initializes the runtime environment of the framework.
     * @return <type>
     */
    public static function initialize()
    {
        if(Nano::$initialized) return;
        Nano::$initialized = true;

        spl_autoload_register(array('Nano','autoload'));
        Nano::addPackages('nano.config.classes');
        Nano::hooks();
    }

    /**
     * Starts the execution of the framework.
     */
    public static function execute()
    {
        if(Nano::$executed) return;
        Nano::$executed = true;

        Nano::app()->run();
    }

    /**
     * Cleans up after that the execution have finished.
     */
    public static function finalize()
    {

    }

    /**
     *  Returns the instance of the current running application.
     * @return <object> The application class.
     */
    public static function app()
    {
        if(Nano::$application == NULL)
            Nano::$application = new NWebApplication('app.config.default');
        return Nano::$application;
    }

    /**
     * Loads and execute hooks on initialization.
     * The hooks are described/configured in package: app.config.hooks
     */
    private static function hooks()
    {
        $hooks = NFramework::import('app.config.hooks');
        if($hooks)
            foreach($hooks as $hook)
            {
                $class = NFramework::klass($hook[0]);
                Nano::import($hook[0]);
                NFramework::invoke($class, $hook[1], $hook[3]);
            }
    }

    /**
     * Adds class package to the autoload mechanism.
     * @param <string> $package
     */
    public static function import($package)
    {
        Nano::$classes[NFramework::klass($package)] = $package;
    }

    /**
     * Adds a bunch of packages of classes for autoloading.
     * @param <string> $package The package path of the descriptions to be imported.
     */
    public static function addPackages($package)
    {
        if($array = NFramework::import($package))
            Nano::$classes = array_merge($array, Nano::$classes);
    }

    /**
     * Tells the package of a class specified.
     * @param <string> $class The class for which to return the package.
     * @return <string> The package of the class.
     */
    public static function package($class)
    {
        return Nano::$classes[$class];
    }

    /**
     * The autoloader of the framework. Is registered att framework initialization.
     * @param <string> $class Class to imported and loaded from file.
     * @return <boolean> true of false if the class was included.
     */
    private static function autoload($class)
    {
        if (class_exists($class))
            return true;

        if(array_key_exists($class, Nano::$classes))
        {
            $load = NFramework::resolve(Nano::$classes[$class],'.php');
            if(file_exists($load))
            {
                include($load);
                return true;
            }
        }
        return false;
    }
}

?>