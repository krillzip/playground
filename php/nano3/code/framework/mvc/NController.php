<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NController
 *
 * @author krillzip
 */
abstract class NController {
    protected $_application;

    public function __construct(NApplication $application) {
        $this->_application = $application;
    }

    public function run($action) {
        $a = NULL;
        $a_arr = $this->actions();
        if(method_exists($this, NController::getActionName($action))) {
            $a = new NAction($this, $action);
        }
        elseif(array_key_exists($action, $a_arr) && NAlias::real($a_arr[$action])) {
            $alias = $a_arr[$action];
            Nano::import($alias);
            $class = NAlias($alias);
            if(is_a($class, 'NInlineAction')) {
                $a = new $class($this, $action);
            }
            else {
                throw new NControllerException('Expected class of type NAction. '.$action.' found.');
            }
        }
        else {
            throw new NControllerException('Action: '.$action.' wasn\'t found in controller');
        }
        return $a->run();
    }

    protected function actions() {
        return array();
    }

    public final static function getActionName($action) {
        return 'action'.ucfirst($action);
    }

    public final static function getControllerName($controller) {
        return ucfirst($controller).'Controller';
    }
}

class NControllerException extends NException {}
