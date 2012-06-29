<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KViewPane
 *
 * @author krillzip
 */
class KViewPane extends KPane{
    private $view;
    private $vars;

    public function __construct(KPaneCollection $collection, $name, $view, $vars = array())
    {
        parent::__construct($collection, $name);
        $this->view = $view;
        $this->vars = $vars;
    }

    public function getContent()
    {
        $clip = KCLip::clip();
        KView::render($this->view, $this->vars);
        return $clip->flush();
    }

    public static function start(KPaneCollection $collection, $name, $view, $vars = array())
    {
        return new KViewPane($collection, $name, $view, $vars);
    }
}
?>