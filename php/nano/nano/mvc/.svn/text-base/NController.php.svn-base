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
class NController {
    protected $_package;
    protected $_params = array();
    protected $_action;

    protected $_pre;
    protected $_post;

    /**
     * Initializes the controller.
     */
    public function __construct()
    {
        $this->_package = Nano::package(__CLASS__);
        $this->_pre = $this->preFilters();
        $this->_post = $this->postFilters();
    }

    /**
     *  Finds and execute the correct action.
     * @param <string> $action
     * @param <array> $params
     */
    public function run($action = 'index', array $params = array())
    {
        $this->_params = $params;
        $this->_action = 'action'.ucfirst($action);
        if(method_exists(self, $this->_action))
        {
            $this->doAction($this->_action);
        }
        else
        {
            array_push($this->_params, $action);
            $this->doAction('actionIndex');
        }
    }

    /**
     *  Prepares and executes an action and its filters.
     * @param <string> $action Action to be executed.
     */
    protected function doAction($action)
    {
        if($this->doFilterList($this->_pre))
            call_user_method($this->_action, self);
        $this->doFilterList($this->_post);
    }

    protected function doFilterList(array $list)
    {
        $result = true;

        return $result;
    }

    /**
     * A list of filters to be executed and passed before execution of an action begins.
     */
    protected abstract function preFilters();

    /**
     * A list of filters to be executed and passed after execution of an action.
     */
    protected abstract function postFilter();

    /**
     * Default action of the controller. Is executed if an called action doesn't exists.
     */
    public abstract function actionIndex();
}
?>