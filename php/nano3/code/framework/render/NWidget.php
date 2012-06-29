<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NWidget
 *
 * @author krillzip
 */
class NWidget {
    protected $_config;
    protected $_panes = array();

    public function __construct(array $config = array(), $autoRun = false){
        $this->_config = $config;
    }

    public function run(){
        
    }

    public function end(){
        
    }

    public function pane($name, array $config = array()){
        $pane = new StdClass();
        $pane->name = $name;
        $pane->config = $config;
        $pane->clip = new NClip(true);
        $this->_panes[] = $pane;
        return $pane->clip;
    }

    public function rez(){
        return array(
            'views'=>array(
            ),
            'css'=>array(
            ),
            'js'=>array(
            ),
        );
    }

    public static function draw($alias, array $config = array()){
        
    }
}