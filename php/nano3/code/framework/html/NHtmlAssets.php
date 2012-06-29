<?php

class NHtmlAssets {
    public static function addJs($alias) {
        $resource = NAlias::resolve($alias, '.js');
        if(file_exists($resource)) {
            $rez = NAlias::rez($alias);
            if(!file_exists(WEBROOT.DS.'js'.DS.$rez.'.js') || !PRODUCTION) {
                copy($resource, WEBROOT.DS.'js'.DS.$rez.'.js');
            }
            return DS.'js'.DS.$rez.'.js';
        }
        else {
            throw new NAssetException('JavaScript asset doesn\'t exist: '.$resource);
        }
    }

    public static function addCss($alias) {
        $resource = NAlias::resolve($alias, '.css');
        if(file_exists($resource)) {
            $rez = NAlias::rez($alias);
            if(!file_exists(WEBROOT.DS.'css'.DS.$rez.'.css') || !PRODUCTION) {
                copy($resource, WEBROOT.DS.'css'.DS.$rez.'.css');
            }
            return DS.'css'.DS.$rez.'.css';
        }
        else {
            throw new NAssetException('StyleSheet asset doesn\'t exist: '.$resource);
        }
    }

    public static function addImage($alias, $ext = '.jpg') {
        $resource = NAlias::resolve($alias, $ext);
        if(file_exists($resource)) {
            $rez = NAlias::rez($alias);
            if(!file_exists(WEBROOT.DS.'images'.DS.$rez.$ext) || !PRODUCTION) {
                copy($resource, WEBROOT.DS.'images'.DS.$rez.$ext);
            }
            return DS.'images'.DS.$rez.$ext;
        }
        else {
            throw new NAssetException('Image asset doesn\'t exist: '.$resource);
        }
    }
}

class NAssetException extends NException {}