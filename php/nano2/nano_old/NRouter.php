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
class NRouter extends NApplicationComponent{
    private $_controller;
    private $_package;
    private $_params = array();

    /**
     * Initializes the routing of the framework.
     */
    protected function initialize()
    {
        if(!$this->matchUri2Controller())
            $this->_package = false;
    }

    /**
     * Takes the URL and tries to find a matching controller.
     */
    protected function matchUri2Controller()
    {
        $found = false;
        $uri = NFramework::trim(explode('/', Nano::app()->request->uri));
        $path = array('app','controllers');
        while($p = array_shift($uri))
        {
            $controller = ucfirst($p).'Control';
            $package = implode('.', $path).'.'.$controller;
            if(NFramework::pathExists($package))
            {
                $this->_package = $package;
                $this->_controller = $controller;
                $this->_params = $uri;
                $found = true;
                break;
            }
            array_push($path,$p);
        }
        return $found;
    }

    /**
     *  returns the class name of the controller.
     * @return <string>
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     *  Returns the package path of the controller.
     * @return <string>
     */
    public function getPath()
    {
        return $this->_package;
    }

    /**
     *  Returns the rest of the uri as parameters in an associative array.
     * @return <array>
     */
    public function getParams()
    {
        return $this->_params;
    }
}
?>