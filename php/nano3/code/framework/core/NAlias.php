<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NAlias
 *  NAlias is a helper class for resolving and checking aliases.
 * @author krillzip
 */
class NAlias {
    private static $_paths = array(
    'app'=>APP_PATH,
    'nano'=>NANO_PATH,
    );

    public static function resolve($alias, $ext = '.php') {
        $path = explode('.', $alias);
        $prefix = array_shift($path);
        return NAlias::$_paths[$prefix].DS.implode(DS,$path).$ext;
    }

    /**
     * Checks whether an alias is a real physical resource
     * @param <allias> $alias The alias to check.
     * @return <boolean> True or false depending on if the resource exists.
     */
    public static function real($alias) {
        return file_exists(NAlias::resolve($alias));
    }

    /**
     *  Returns the class part of an alias.
     * @param <alias> $alias The alias from which to extrat the class.
     * @return <alias> The
     */
    public static function klass($alias) {
        $path = explode('.', $alias);
        return ucfirst(array_pop($path));
    }

    public static function rez($alias){
        $path = explode('.', $alias);
        return array_pop($path);
    }

    /**
     *  Returns the path part of an alias.
     * @param <alias> $alias The alias from which to extract the path.
     * @return <alias> The path part of the alias.
     */
    public static function path($alias) {
        $path = explode('.', $alias);
        array_pop($path);
        return implode('.', $path);
    }
}