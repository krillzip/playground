<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NClip
 *
 * @author krillzip
 */
class NClip {
    private $clipping = false;
    private $buffer = NULL;

    public function __construct($begin = false)
    {
        if($begin)
            $this->begin();
    }

    public function begin()
    {
        $this->clipping = true;
        ob_start();
    }

    public function end()
    {
        if($this->clipping)
        {
            $this->buffer = ob_get_clean();
            $this->clipping = false;
        }
    }

    public function flush()
    {
        if($this->clipping)
            $this->end();
        return $this->buffer;
    }

    public static function clip()
    {
        return new NClip(true);
    }
}
?>