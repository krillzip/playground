<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NAction
 *
 * @author krillzip
 */
class NAction extends NActionBase{
    protected $_callback;

    public function __construct(NController $controller, $action){
        parent::__construct($controller, $action);
        $method = NController::getActionName($action);
        if(method_exists($controller, $method)){
            $this->_callback = array($controller, $method);
        }
        else{
            throw new NActionException('The given controller doesn\'t have the method: '.$method);
        }
    }

    public final function run(){
        return call_user_func($this->_callback);
    }
}
