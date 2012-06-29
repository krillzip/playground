<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDataStorage
 *
 * @author krillzip
 */
abstract class NDataStorage {
    const FILE = 'fileStorage';
    const DB = 'dbStorage';
    const SESSION = 'sessionStorage';

    protected static $_instances = array();

    public static function factory($type)
    {
        switch($type)
        {
            case NDataStorage::SESSION:
                if(!isset(self::$_instances[self::SESSION]))
                    self::$_instances[self::SESSION] = new NSessionStorage($params, $options);
                return self::$_instances[self::SESSION];
            default:
                return false;
        }
    }

    public abstract function __construct();
    public abstract function synchronize(array $data, $namespace);
    public abstract function get($name, $namespace);
    public abstract function set($name, $value, $expire, $namespace);
    public abstract function add($name, $value, $namespace);
    public abstract function delete($name, $namespace);
    public abstract function flush($namespace);
    public abstract function namespace($namespace);
}
?>
