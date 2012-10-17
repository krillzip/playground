<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NAutoloader
 *
 * @author krillzip
 */
class NAutoloader {

    protected static $classes;

    public static function autoload($class) {
        if (class_exists($class) || interface_exists($class)) {
            return true;
        } elseif (isset(self::$classes[$class])) {
            $file = self::$classes[$class];
            if (!(file_exists($file) && is_readable($file))) {
                throw new NAutoloaderException('File "' . $file . '" doesn\'t exist or is not readable', NAutoloaderException::LOAD_FAILURE);
            }
            require self::$classes[$class];
            if (class_exists($class) || interface_exists($class)) {
                return true;
            } else {
                throw new NAutoloaderException('Class "' . $class . '" was not found in "' . self::$classes[$class] . '".', NAutoloaderException::CLASS_MISSING);
            }
        } else {
            return false;
        }
    }

    public static function initialize($classes) {
        spl_autoload_register(array('NAutoloader', 'autoload'));
        self::$classes = $classes;
    }

    public static function indexClasses() {
        $classes = array();
        $pattern = '[A-Z]*.php';
        // Find all files that may contain a class.
        $fileList = array_merge(
                self::rglob($pattern, GLOB_MARK, SYS_PATH . DS), self::rglob($pattern, GLOB_MARK, APP_PATH . DS)
        );

        // Filter all files within the vendors folder
        function filter($value) {
            return strpos('vendors', $value) === false ? true : false;
        }

        $fileList = array_filter($fileList, 'filter');

        // Extract class name and build class/file array.
        foreach ($fileList as $file) {
            $position = strrpos($file, DS);
            $class = substr($file, $position + 1, strlen($file) - ($position + 5));
            $classes[$class] = $file;
        }

        return $classes;
    }

    // Borrowed from snipplr http://snipplr.com/view.php?codeview&id=16233
    protected static function rglob($pattern, $flags = 0, $path = '') {
        if (!$path && ($dir = dirname($pattern)) != '.') {
            if ($dir == '\\' || $dir == '/')
                $dir = '';
            return self::rglob(basename($pattern), $flags, $dir . DS);
        }
        $paths = glob($path . '*', GLOB_ONLYDIR | GLOB_NOSORT);
        $files = glob($path . $pattern, $flags);
        foreach ($paths as $p)
            $files = array_merge($files, self::rglob($pattern, $flags, $p . DS));
        return $files;
    }

}

class NAutoloaderException extends Exception {

    const LOAD_FAILURE = 1;
    const CLASS_MISSING = 2;

}