<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KPaneCollection
 *
 * @author krillzip
 */
abstract class KPaneCollection extends KObject{
    private $panes = array();
    private $clipping = false;
    private $count;

    public function __construct($begin = true)
    {
        if($begin)
            $this->begin();
    }

    public function begin()
    {
        $this->clipping = true;
    }

    public function end()
    {
        $this->clipping = false;
    }

    public function getId()
    {
        static $counter = NULL;
        if($counter == NULL)
            $counter = 0;
        if(empty($this->count))
            $this->count = ++$counter;
        return $this->count;
    }

    public function addPane(KPane $pane)
    {
        if($this->clipping)
            $this->panes[$pane->name] = $pane;
    }

    protected abstract function assets();
    protected abstract function view();

    public function flush()
    {
        if($this->clipping)
            $this->end();
        $assets = $this->assets();
        if(!empty($assets['css']))
            foreach($assets['css'] as $css)
                 System::app()->assets->registerStylesheets($css);
        if(!empty($assets['js']))
            foreach($assets['js'] as $js)
                 System::app()->assets->registerJavaScript($js);

        KView::render($this->view(), array(
                'panes'=>$this->panes,
                'id'=>$this->getId()
            )
        );
    }
}
?>
