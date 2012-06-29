<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 */
class MainControl extends NController
{
    public function actionIndex()
    {
        return array(
            'content'=>'Hello world!<br /> Your browser is: '.
            Nano::app()->request->browser.' '.
            Nano::app()->request->version
        );
    }

    public function actionHello()
    {
        return array(
            'content'=>'Hello world! This is the other side!<br /> Your browser is: '.
            Nano::app()->request->browser.' '.
            Nano::app()->request->version
        );
    }

    public function inputFilters()
    {
        return array();
    }

    public function outputFilters()
    {
        return array();
    }
}

?>