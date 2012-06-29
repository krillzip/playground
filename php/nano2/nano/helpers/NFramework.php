<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Framework
 * Containes a small library of methods to help with fundamental
 * operations of the framework.
 *
 * @author krillzip
 */
class NFramework {
    private static $paths = array(
        'app'=>APPLICATION_PATH,
        'plugin'=>PLUGINS_PATH,
        'nano'=>NANO_PATH
    );

    /**
     *  Resolves package paths for the framework.
     * @param <string> $package A package to resolve.
     * @param <string> $ext File extension to add of the generated path
     * @return <string> The correct path to the resource resolved.
     */
    public static function resolve($package, $ext = '')
    {
        if(!NFramework::isAlias($package))
            return false;
        $alias = explode('.', $package);
        $prefix = array_shift($alias);
        return self::$paths[$prefix].DS.implode(DS,$alias).$ext;
    }

    /**
     *  checks if a certain package exixts on file system.
     * @param <string> $package
     * @return <string>
     */
    public static function pathExists($package)
    {
        return file_exists(NFramework::resolve($package));
    }

    /**
     *  Validates an alias.
     * @param <string> $package
     * @return <boolean>
     */
    public static function isAlias($package)
    {
        return preg_match('/^nano\.|^app\.|^plugins\./', $package) == 1;
    }

    /**
     * Returns the name of the class that the package points to.
     * @param <string> $package
     * @return <string> The class name in upper camelcase.
     */
    public static function klass($package)
    {
        $alias = explode('.', $package);
        return ucfirst(array_pop($alias));
    }

    /**
     *  Returns the path port of an package.
     * @param <string> $package
     * @return <string>
     */
    public static function path($package)
    {
        $alias = explode('.', $package);
        array_pop($alias);
        return implode('.', $alias);
    }

    /**
     * Imports stored/exporeted variables from a php file.
     * @param <srting> $package Package path to the stored variables.
     * @return <array> returns an associative array of values.
     */
    public static function import($package)
    {
        return include(NFramework::resolve($package, '.php'));
    }

    /**
     * Exports an associative array of values to be stored on the file system.
     * @param <array> $data Associative array of values to be exported.
     * @param <string> $package A package path where data will be stored.
     * @return <boolean> returns true on success.
     */
    public static function export(array $data, $package)
    {
        return file_put_contents(NFramework::resolve($package, '.php'), '<?php\n\nreturn '.$data.'\n\n?>');
    }

    /**
     * Filters the array of empty values.
     * @param <array> $arr Array to filter.
     * @return <array> filtered array.
     */
    public static function trim(array $arr)
    {
        return array_filter($arr);
    }

    /**
     *  Invokes a class method.
     * @param <string> $class Class or/and package of class to use.
     * @param <string> $method The method of the class to invoke.
     * @param <array> $params Associative array of parameters to use when invoking method.
     * @return <mixed> The result of the invoked method or false on error.
     */
    public static function invoke($class, $method, array $params = array())
    {
        if(!(is_object($class) || strpos($class, '.') === false))
        {
            Nano::import($class);
            $class = NFramework::klass($class);
        }
        return call_user_func_array(array($class, $method), $params);
    }

    /**
     *  Translates a local filsystem path to the correct URL compared to the WEBROOT.
     * @param <string> $path Local file system path to translate.
     * @return <string> Corresponding URL to the path given.
     */
    public static function path2url($path)
    {
        $len = strlen(WEBROOT);
        $pos = strpos($path, WEBROOT);
        if($pos === false)
            return false;
        $str = substr($path, $len + $pos);
        $s = explode(DS, $str);
        array_shift($s);
        return APPURL.'/'.implode('/', $s);
    }

    /**
     *  Gives the method name of an controller action.
     * @param <string> $method Action name.
     * @return <string> Method name for the action given.
     */
    public static function action($method)
    {
        return 'action'.ucfirst($method);
    }
}
?>