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
class Clip {
    private $_clipping = false;
    private $_buffer = NULL;

    public function __construct($begin = false)
    {
        if($begin)
            $this->begin();
    }

    public function begin()
    {
        $this->_clipping = true;
        ob_start();
    }

    public function end()
    {
        if($this->_clipping)
        {
            $this->_buffer = ob_get_clean();
            $this->_clipping = false;
        }
    }

    public function flush()
    {
        if($this->_clipping)
            $this->end();
        return $this->_buffer;
    }

    public static function clip()
    {
        return new Clip(true);
    }
}
?>