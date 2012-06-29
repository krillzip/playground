<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NActionBase
 *
 * @author krillzip
 */
abstract class NActionBase {
    protected $_controller;
    protected $_action;

    public function __construct(NController $controller, $action){
        $this->_controller = $controller;
        $this->_action = $action;
    }

    public abstract function run();
}

class NActionException extends NException{}