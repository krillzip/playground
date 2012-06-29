<?php

/**
 * 
 */
class NRouter extends NObject{
    protected $_config;
    protected $_router;

    public function __construct(array $config = array()) {
        $this->_config = $config;
        $alias = $this->_config['adapter'];
        if(NAlias::real($alias)){
            Nano::import($alias);
            $class = NAlias::klass($alias);
            $this->_router = new $class($this->_config['routes']);
        }else{
            throw new NRouterException('Router Adapter: '.$alias.' doesn\'t exist.');
        }
    }

    public function findRoute($url) {
        $route = $this->_router->findRoute($url);
    }

    public function createUrl($route, $args = array()) {
        return $this->_router->createUrl($route, $args);
    }

    public function getRoute(){
        return $this->_router->route;
    }

    public function getParams(){
        return $this->_router->params;
    }
}

class NRouterException extends NException{}