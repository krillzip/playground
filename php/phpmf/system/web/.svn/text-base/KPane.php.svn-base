<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KPane
 *
 * @author krillzip
 */
abstract class KPane extends KObject{
    private $collection;
    private $name;

    public function __construct(KPaneCollection $collection, $name)
    {
        $this->collection = $collection;
        $this->name = $name;
        $this->collection->addPane($this);
    }

    public abstract function getContent();

    public function getName()
    {
        return $this->name;
    }

    /*public static function start(KPaneCollection $collection, $name)
    {
        return new KPane($tabs, $name);
    }*/
}
?>