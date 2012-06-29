<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NController
 *
 * @author krillzip
 */
abstract class NController extends NObject {
    protected $_package;
    protected $_action;
    protected $_renderer = NRender::XHTML;
    protected $_output = array();
    protected $_options = array();

    /**
     * Initializes the controller.
     */
    public function __construct($action = 'index')
    {
        $this->_package = Nano::package(__CLASS__);

        if(method_exists($this, NFramework::action($action)))
            $this->_action = $action;
        else
            $this->_action = 'index';

        $this->_options = array('layout'=>'', 'view'=>'app.views.default');
    }

    /**
     *  Finds and execute the correct action.
     * @param <string> $action
     * @param <array> $params
     */
    public function run()
    {
        $this->_output = NFramework::invoke($this, NFramework::action($this->_action));
    }

    /**
     *  Returns the generated output.
     * @return <mixed> Whatever the action returned.
     */
    public function getOutput()
    {
        return $this->_output;
    }

    /**
     *  Returns render options.
     * @return <array> view, layout and more.
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     *  Returns the choosen renderer.
     * @return <string> The renderer choosen.
     */
    public function getRenderer()
    {
        return $this->_renderer;
    }

    /**
     *  Returns the input filters for the current action at controller level.
     * @return <array> list of filters.
     */
    public function getInputFilters()
    {
        $filters = $this->inputFilters();
        if(isset($filters[$this->_action]))
            return  $filters[$this->_action];
        else
            return array();
    }

    /**
     *  Returns the output filters for the current action at controller level.
     * @return <array> list of filters.
     */
    public function getOutputFilters()
    {
        $filters = $this->outputFilters();
        if(isset($filters[$this->_action]))
            return  $filters[$this->_action];
        else
            return array();
    }

    /**
     * Returns the input filters for the controller action.
     * Override this method.
     */
    public abstract function inputFilters();

    /**
     * Returns the output filters for the controller action.
     * Override this method.
     */
    public abstract function outputFilters();

    /**
     * Default action of the controller. Is executed if an called action doesn't exists.
     */
    public abstract function actionIndex();
}
?>