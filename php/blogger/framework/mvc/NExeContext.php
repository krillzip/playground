<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NExeContext
 *
 * @author krillzip
 */
class NExeContext extends NComponent {

    protected $params = array();
    protected $controllerId;
    protected $actionId;
    protected $controllerInstance;
    protected $actionInstance;

    public function init() {
        $this->controllerInstance = $this->createController($this->controllerId);
        $this->actionInstance = $this->createAction($this->actionId, $this->controllerInstance);
    }

    public function execute() {
        $this->actionInstance->run();
    }

    public function createController($id) {
        $controllerClass = NUtil::translateController($id);
        $controllerInstance = new $controllerClass($this, $id);
        return $controllerInstance;
    }

    public function createAction($id, IController $controllerInstance) {
        $reflection = new ReflectionClass($controllerInstance);
        $actionMethod = NUtil::translateActionMethod($id);
        if ($reflection->hasMethod($actionMethod)) {
            $actionInstance = new NInlineAction($this, $id, array($controllerInstance, $actionMethod));
        } else {
            $actions = $controllerInstance->actions();
            if (!isset($actions[$id])) {
                throw new NExeContextException('No action "' . $id . '" found on controller.', NExeContextException::NO_ACTION_FOUND);
            }
            $actionClass = NUtil::translateAction($id);
            $actionInstance = new $actionClass($this, $id);
        }

        return $actionInstance;
    }

    public function setController($id) {
        $this->controllerId = empty($id) ? NApplication::DEFAULT_CONTROLLER_ID : $id;
    }

    public function getController() {
        return $this->controllerId;
    }

    public function setAction($id) {
        $this->actionId = empty($id) ? NApplication::DEFAULT_ACTION_ID : $id;
    }

    public function getAction() {
        return $this->actionId;
    }

    public function setParams(array $params) {
        $this->params = $params;
    }

    public function getParams() {
        return $this->params;
    }

}

class NExeContextException extends Exception {

    const NO_ACTION_FOUND = 1;

}