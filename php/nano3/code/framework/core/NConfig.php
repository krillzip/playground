<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NConfig
 *  Helper and Handler of configuration files.
 * @author krillzip
 */
class NConfig {

/**
 * Imports stored/exported variables and configurations from a php file.
 * @param <alias> $alias Alias to the configuration.
 * @return <config> returns a configuration as an associative array.
 */
    public static function import($alias, $silent = false) {
        $path = NAlias::resolve($alias);
        if(!file_exists($path) && !$silent) {
            throw new NConfigException('<$alias> to be imported doesn\'t exists in real.');
        }

        $import = NULL;
        if(file_exists($path)) {
            $import = include($path);
        }

        if(is_array($import)) {
            return $import;
        }
        elseif($silent) {
            return array();
        }
        else {
            throw new NConfigException('<$alias> to be imported doesn\'t return an array.');
        }
    }

    /**
     * Exports an associative array of values to be stored on the file system.
     * @param <config> $config Configuration to be saved.
     * @param <alias> $alias The alias where to store the resource.
     * @return <boolean> returns true on success.
     */
    public static function export($alias, array $config) {
        return file_put_contents(NAlias::resolve($alias), '<?php

return '.var_export($config, true).';');
    }

    public static function merge() {
        $args = func_get_args();
        $merge = array();
        foreach($args as $key => $arg) {
            if(is_array($arg)) {
                $merge = array_merge($merge, $arg);
            }
            elseif(is_string($arg) && NAlias::real($arg)) {
                $merge = array_merge($merge, NConfig::import($arg));
            }
            else {
                throw new NConfigException('Argument must be either an <$alias> or a <$config> array.');
            }
        }
        return $merge;
    }

    public static function build($alias, $build) {
        $path = NAlias::resolve($alias);
        if(!file_exists($path)) {
            $config = NConfig::import($build);
            NConfig::export($alias, $config);
            return $config;
        }
        else {
            return NConfig::import($alias);
        }
    }
}

class NConfigException extends NException {}