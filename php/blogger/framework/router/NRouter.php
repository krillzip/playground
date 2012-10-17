<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRouter
 *
 * @author krillzip
 */
class NRouter extends NApplicationComponent {

    protected $rulesConfig = array();
    protected $rules = array();
    protected $urlRoot;
    protected $urlPath;

    public function init() {
        $this->urlRoot = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '/';
        $this->urlPath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

        foreach ($this->rulesConfig as $rule => $config) {
            if (empty($config['class'])) {
                throw new NRouterException('No class given for RouteRule "' . $rule . '".', NRouterException::RULE_NO_CLASS);
            } else {
                $ruleClass = $config['class'];
                unset($config['class']);
            }

            $ruleInstance = new $ruleClass($this);
            NUtil::configureComponent(new NConfig($config), $ruleInstance);
            $this->rules[$rule] = $ruleInstance;
        }
    }

    public function createUrl($controller, $action, array $params = array()) {
        $result = false;
        foreach ($this->rules as $rule) {
            $result = $rule->createUrl($controller, $action, $params);
            if ($result !== false) {
                return $result;
            }
        }
        return $result;
    }

    public function calculateRoute() {
        $result = false;
        foreach ($this->rules as $rule) {
            if ($result = $rule->calculateRoute() === true) {
                break;
            }
        }
        if ($result !== true) {
            throw new NRouterException('Could not calculate route.', NRouterException::CALC_ROUTE_FAIL);
        }

        $config = new NConfig(array(
                    'controller' => $rule->getController(),
                    'action' => $rule->getAction(),
                    'params' => $rule->getParams()
                ));

        $context = new NExeContext();
        NUtil::configureComponent($config, $context);
        return $context;
    }

    public function setRules(array $rules) {
        $this->rulesConfig = $rules;
    }

    public function getUrlRoot() {
        return $this->urlRoot;
    }

    public function getUrlPath() {
        return $this->urlPath;
    }

}

class NRouterException extends Exception {

    const RULE_NO_CLASS = 1;
    const CALC_ROUTE_FAIL = 2;

}