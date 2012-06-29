<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of System
 *
 * @author krillzip
 */
class System {
    private static $packages = array(
    'KObject'=>'system.base.KObject',
    'KConfiguration'=>'system.base.KConfiguration',
    'System'=>'system.base.System',
    );

    private static $app;

    public static function app()
    {
        return self::$app;
    }

    public static function debugging()
    {
        
    }

    public static function production()
    {
        return PRODUCTION;
    }

    public static function import($package)
    {
        $alias = explode('.', $package);
        $class = array_pop($alias);
        System::$packages[$class] = $package;
    }

    public static function aliasResolver($package)
    {
        $alias = explode('.', $package);
        switch(array_shift($alias))
        {
            case 'application':
                $prefix = APPLICATION_PATH;
                break;
            case 'plugin':
                $prefix = PLUGIN_PATH;
                break;
            case 'system':
                $prefix = SYSTEM_PATH;
                break;
            default:
                throw new Exception();
                break;
        }
        return $prefix.DS.implode(DS,$alias);
    }

    public static function pathAlias($package)
    {
        return self::aliasResolver($package).'.php';
    }

    public static function viewAlias($package)
    {
        return self::aliasResolver($package).'.view.php';
    }

    public static function autoload($class)
    {
        if (class_exists($class))
            return true;

        if(array_key_exists($class, System::$packages))
        {
            $load = System::pathAlias(System::$packages[$class]);
            if(file_exists($load))
            {
                include($load);
                return true;
            }
        }
        return false;
    }

    public static function initialize($application)
    {
        spl_autoload_register(array('System', 'autoload'));
        try {
            System::$packages = array_merge(
                KConfiguration::load('application.config.classes'),
                KConfiguration::load('system.config.classes'),
                System::$packages
            );
        }catch(Exception $e){}
        System::import($application);
        $path = explode('.', $application);
        $app = array_pop($path);
        System::$app = new $app();
    }
}
?>