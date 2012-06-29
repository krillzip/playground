<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KClipPane
 *
 * @author krillzip
 */
class KClipPane extends KPane{
    private $clip;

    public function __construct(KPaneCollection $collection, $name, $begin = true)
    {
        parent::__construct($collection, $name);
        if($begin)
            $this->begin();
    }

    public function begin()
    {
        $this->clip = KClip::clip();
    }

    public function end()
    {
        $this->clip->end();
    }

    public function getContent()
    {
        return $this->clip->flush();
    }

    public static function start(KPaneCollection $collection, $name)
    {
        return new KClipPane($collection, $name);
    }
}
?>
