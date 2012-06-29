<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NInlineAction
 *
 * @author krillzip
 */
abstract class NInlineAction extends NActionBase{
    public function __construct(NController $controller, $action){
        parent::__construct($controller, $action);
    }

    public final function run(){
        return $this->internalAction();
    }

    protected abstract function internalAction();
}
?>
