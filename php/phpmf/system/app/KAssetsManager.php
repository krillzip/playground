<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KAssetsManager
 *
 * @author krillzip
 */
class KAssetsManager extends KApplicationManager{
    protected $assets = array();

    public function __construct()
    {
        parent::__construct();
    }

    protected function copyAsset($path, $dest)
    {
        if(!file_exists($path))
            throw new Exception();
        if(!file_exists($dest) || !System::production())
            if(!copy($path, $dest))
                    throw new Exception();
    }

    public function registerImage($path)
    {
        $dest = WEBROOT.DS.'images'.DS.basename($path);
        $this->copyAsset($path, $dest);
        return $dest;
    }

    public function registerJavascript($alias)
    {
        $source = System::aliasResolver($alias).'.js';
        $dest = WEBROOT.DS.'js'.DS.basename($source);
        $this->copyAsset($source, $dest);
        System::app()->html->registerJS(System::app()->pathToUrl($dest));
        return $dest;
    }

    public function registerStylesheets($alias)
    {
        $source = System::aliasResolver($alias).'.css';
        $dest = WEBROOT.DS.'css'.DS.basename($source);
        $this->copyAsset($source, $dest);
        System::app()->html->registerCSS(System::app()->pathToUrl($dest));
        return $dest;
    }

    public function registerFlash($alias)
    {
        $source = System::aliasResolver($alias).'.swf';
        $dest = WEBROOT.DS.'swf'.DS.basename($source);
        $this->copyAsset($source, $dest);
        return $dest;
    }
}
?>