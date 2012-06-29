<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NApplicationComponent
 * Baseclass for all the application components that exists.
 *
 * @author krillzip
 */
abstract class NApplicationComponent extends NObject{
    protected $_config = array();

    /**
     *  Initializes the application component
     */
    final public function __construct($config)
    {
        if(is_array($config))
            $this->_config = $config;
        $this->initialize();
    }

    /**
     * Abstract function for custom initialization of the app component.
     */
    protected abstract function initialize();
}
?>
