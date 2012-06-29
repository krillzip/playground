<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRouterBase
 *
 * @author krillzip
 */
abstract class NRouterAdapterBase extends NObject implements IRouterAdapter{
    protected $_routes;
    protected $_route = NULL;
    protected $_params = array();

    public function __construct(array $routes){
        $this->_routes = $routes;
    }

    public function getRoute(){
        return $this->_route;
    }

    public function getParams(){
        return $this->_params;
    }

    //public abstract function createUrl($route, array $params = array(), $absolute = false);
    //public abstract function findRoute($uri);
}