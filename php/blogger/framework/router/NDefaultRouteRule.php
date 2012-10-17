<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NDefaultRouteRule
 *
 * @author krillzip
 */
class NDefaultRouteRule extends NRouteRuleBase {

    const ROUTE_PARAM = 'r';

    public function createUrl($controller, $action, array $params) {
        return $this->router->getUrlRoot() . '?' . http_build_query(array_merge(array(NDefaultRouteRule::ROUTE_PARAM => $controller . '/' . $action), $params));
    }

    public function calculateRoute() {
        $this->params = array_merge($_GET);

        if (!isset($this->params[NDefaultRouteRule::ROUTE_PARAM])) {
            $route = '';
        } else {
            $route = $this->params[NDefaultRouteRule::ROUTE_PARAM];
        }

        $rParts = explode('/', $route);
        $rParts = array_filter($rParts);
        $this->controllerId = empty($rParts[0]) ? NULL : $rParts[0];
        $this->actionId = empty($rParts[1]) ? NULL : $rParts[1];

        return true;
    }

}