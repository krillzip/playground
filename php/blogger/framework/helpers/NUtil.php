<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NUtil
 *
 * @author krillzip
 */
class NUtil {

    public static function configureComponent(NConfig &$config, NComponent &$component) {
        foreach ($config as $key => $value) {
            $component->$key = $value;
        }
    }

    public static function translateController($id) {
        return ucfirst($id) . 'Controller';
    }

    public static function translateAction($id) {
        return ucfirst($id) . 'Action';
    }

    public static function translateActionMethod($id) {
        return 'action' . ucfirst($id);
    }

    public static function getLayoutPath($layout) {
        return NSys::app()->viewPath . DS . 'layout' . DS . $layout . '.php';
    }

    public static function getViewPath(NExeContext $ec, $view = NULL) {
        return NSys::app()->viewPath . DS . $ec->getController() . DS . (is_null($view) === true ? $ec->getAction() : $view) . '.php';
    }

}