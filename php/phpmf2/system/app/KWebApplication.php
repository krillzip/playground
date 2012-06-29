<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KWebApplication
 *
 * @author krillzip
 */
class KWebApplication extends KApplication{

    private $html;
    private $assets;
    private $database;
    private $request;

    public function __construct()
    {

    }

    public function run()
    {
        
    }

    public function getHtml()
    {
        if(empty($this->html))
            $this->html = new KHtmlManager();
        return $this->html;
    }

    public function getAssets()
    {
        if(empty($this->assets))
            $this->assets = new KAssetsManager();
        return $this->assets;
    }

    public function getDbms()
    {
        if(empty($this->database))
            $this->database = new KDatabaseManager();
        return $this->database;
    }

    public function getDb()
    {
        return $this->dbms->shema;
    }

    public function getRequest()
    {
        if(empty($this->request))
            $this->request = new KHttpRequest();
        return $this->request;
    }

    public function pathToUrl($path)
    {
        $len = strlen(WEBROOT);
        $pos = strpos($path, WEBROOT);
        if($pos === false)
            throw new Exception();
        $str = substr($path, $len + $pos);
        $s = explode(DS, $str);
        array_shift($s);
        return APPURL.'/'.implode('/', $s);
    }
}

?>