<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NView
 *
 * @author krillzip
 */
class NView
{
    private $_data = array();
    private $_buffer;

    public function __construct($path, $params = NULL, $flush = false)
    {
        if(is_array($params))
            $this->_data = $params;
        elseif(is_string($params))
            $this->_data = NFramework::import($params);
        else
            throw new Exception();

        $path = NFramework::resolve($path, '.view.php');
        $this->sanetize();
        if(!$flush)
        {
            $this->_buffer = NClip::clip();
            $this->draw($path);
            $this->_buffer->end();
        }
        else
            $this->draw($path);
    }

    protected function sanetize()
    {
        unset($this->_data['_GET']);
        unset($this->_data['_POST']);
        unset($this->_data['_REQUEST']);
        unset($this->_data['_SERVER']);
        unset($this->_data['_COOKIE']);
        unset($this->_data['_FILES']);
        unset($this->_data['_ENV']);
        unset($this->_data['_SESSION']);
        unset($this->_data['_path_']);
    }

    protected function draw($_path_)
    {
        extract($this->_data, EXTR_REFS);
        include($_path_);
    }

    public static function render($path, $params, $flush = true)
    {
        $view = new NView($path, $params, $flush);
        if(!$flush)
            return $view->_buffer;
        else
            return true;
    }
}
?>