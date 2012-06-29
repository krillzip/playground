<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NApplication
 *  The NApplication class handles the execution order of a request.
 * @author krillzip
 */
class NApplication {
    private static $_instance = NULL;

    protected $_controller;
    protected $_action;
    protected $_route;
    protected $_params;

    public static function getInstance(){
        if(!self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function run(){
        $facade = Nano::f();
        $uri = $facade->ua->uri;
        $facade->router->findRoute($uri);
        $this->_route = $facade->router->route;
        $this->_params = $facade->router->params;

        $route = explode('/', $this->_route);
        $this->_action = $route[1];
        $controller = NController::getControllerName($route[0]);
        $this->_controller = new $controller($this);
        
        $data = $this->_controller->run($this->_action);

        $html = Nano::f()->html;
        $html->standard = NHtml::STRICT;
        $html->layout = 'nano.views.3columns';
        $html->content = $data;
        $html->view = 'app.views.default.index';
        $html->render();
    }
}
