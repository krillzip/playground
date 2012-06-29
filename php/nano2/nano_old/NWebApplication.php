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
class NWebApplication extends NApplication{
    private $_controller;
    private $_action = 'index';
    private $_buffer;
    
    /**
     * Executes the web application, loading the right controller and action.
     */
    public function run()
    {
        $controller = $this->findController();
        $this->_controller = new $controller($this->_action);

        $this->executeFilters(
            $this->_config['filters']['input'],
            $this->_controller->inputFilters
        );

        $this->_controller->run();
        $this->_buffer = NClip::clip();
        NRender::factory(
            $this->_controller->renderer,
            $this->_controller->output,
            $this->_controller->options
        )->render();
        $this->_buffer->end();

        $this->executeFilters(
            $this->_config['filters']['output'],
            $this->_controller->outputFilters
        );
        echo $this->_buffer->flush();
    }

    /**
     *  Executes two lists of filter classes.
     * @param <array> $filters1
     * @param <array> $filters2
     */
    protected function executeFilters(array $filters1, array $filters2)
    {
        $filters = array_merge($filters1, $filters2);
        foreach($filters as $name=>$filter)
            NFramework::invoke($filter, 'filter');
    }

    /**
     *  Finds out the controller and action to be executed width this request.
     * @return <string>
     */
    protected function findController()
    {
        $params = $this->router->params;
        if(count($params))
            $this->_action = $params[0];
        $_GET['_uri'] = $params;

        $controller = $this->router->controller;
        if(!empty($controller))
        {
            Nano::import($this->router->path);
        }
        else
        {
            $controller = NFramework::klass($this->_config['controller']['default']);
            Nano::import($this->_config['controller']['default']);
        }

        return $controller;
    }

    /**
     *  Returns the instance of the routing class.
     * @return <object>
     */
    public function getRouter()
    {
        return $this->returnComponent('router');
    }

    /**
     *  Returns the instance of the request class.
     * @return <object>
     */
    public function getRequest()
    {
        return $this->returnComponent('request');
    }

    /**
     *  Returns the instance of the asset manager.
     * @return <object>
     */
    public function getAssets()
    {
        return $this->returnComponent('assets');
    }

    /**
     *  Returns the instance of the database manager.
     * @return <object>
     */
    public function getDb()
    {
        return $this->returnComponent('db');
    }

    protected function components()
    {
        return array(
            'router'=>'NRouter',
            'request'=>'NHttpRequest',
            'assets'=>'NAssetManager',
            'db'=>'NDatabaseManager',
        );
    }

    /**
     *  Returns the webbapp configuration
     * @return <array>
     */
    public function getConfig()
    {
        return $this->_config;
    }
}
?>