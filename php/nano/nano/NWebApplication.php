<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NWebApplication
 *
 * @author krillzip
 */
class NWebApplication extends NObject{
    private $_config;
    private $_router;
    private $_request;

    private $_controller;
    private $_params;

    public function __construt()
    {
        $this->_config = NFramework::import('app.config.web');
    }
    
    /**
     * Executes the web application, loading the right controller and action.
     */
    public function run()
    {
        $controller = $this->router->controller;
        $this->_params = $this->router->params;
        Nano::import($this->router->path);
        $action = array_shift($this->_params);
        $this->_controller = new $controller($action, $this->_params);
    }

    /**
     *  Returns the instance of the routing class.
     * @return <object>
     */
    public function getRouter()
    {
        if(!isset($this->_router))
            $this->_router = new NRouter();
        return $this->_router;
    }

    /**
     *  Returns the instance of the request class.
     * @return <object>
     */
    public function getRequest()
    {
        if(!isset($this->_request))
            $this->_request = new NHttpRequest();
        return $this->_request;
    }
}
?>