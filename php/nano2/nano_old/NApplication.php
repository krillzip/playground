<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NApplication
 *
 * @author krillzip
 */
abstract class NApplication extends NObject{
    protected $_config;
    protected $_components = array();

    /**
     *  Initializes the NApplication class;
     * @param <string> $config an Alias to the config file containing the application component configuration.
     */
    public function __construct($config)
    {
        $this->_config = NFramework::import($config);
    }

    /**
     *  Returns and initializes an application component.
     * @param <string> $comp Component to return/initialize.
     * @return <object> The application component object returned.
     */
    protected function returnComponent($comp)
    {
        if(!isset($this->_components[$comp]))
        {
            $components = $this->components();
            if(array_key_exists($comp, $components))
            {
                $class = $components[$comp];
                $config = NULL;
                if(array_key_exists($comp, $this->_config))
                    $config = $this->_config[$comp];
                $this->_components[$comp] = new $class($config);
            }
            else
                throw new Exception();
        }
        return $this->_components[$comp];
    }

    /**
     *  The run function of the application to be implemented.
     */
    abstract public function run();

    /**
     *  A abstract function supposed to return an associative array with enabled
     * application components.
     */
    abstract protected function components();
}
?>