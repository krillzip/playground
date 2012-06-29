<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KView
 *
 * @author krillzip
 */
class KView extends KObject{
    private $data = array();

    public function __construct($path, $vars = NULL)
    {
        if(is_array($vars))
            $this->data = $vars;
        elseif(is_string($vars))
            $this->data = KConfiguaration::load($vars);
        else
            throw new Exception();

        $this->sanetize();
        $this->draw(System::viewAlias($path));
    }

    protected function sanetize()
    {
        unset($this->data['_GET']);
        unset($this->data['_POST']);
        unset($this->data['_REQUEST']);
        unset($this->data['_SERVER']);
        unset($this->data['_COOKIE']);
        unset($this->data['_FILES']);
        unset($this->data['_ENV']);
        unset($this->data['_SESSION']);
        unset($this->data['_path_']);
    }

    protected function draw($_path_)
    {
        extract($this->data);
        include($_path_);
    }

    public static function render($path, $vars)
    {
        $view = new KView($path, $vars);
        unset($view);
    }
}
?>