<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRouteRuleBase
 *
 * @author krillzip
 */
abstract class NRouteRuleBase extends NComponent implements IRouteRule {

    protected $router;
    protected $controllerId;
    protected $actionId;
    protected $params = array();

    public function __construct(NRouter $router) {
        $this->router = $router;
    }

    public abstract function calculateRoute();

    public abstract function createUrl($controller, $action, array $params);

    public function getController() {
        return $this->controllerId;
    }

    public function getAction() {
        return $this->actionId;
    }

    public function getParams() {
        return $this->params;
    }

}
