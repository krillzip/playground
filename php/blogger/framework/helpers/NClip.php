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

    protected $buffer = '';
    protected $started = false;

    public static function start() {
        $clip = new NClip();
        $clip->begin();
        return $clip;
    }

    public function begin() {
        ob_start();
        $this->started = true;
    }

    public function end() {
        if (!$this->started) {
            return;
        }
        $this->buffer = ob_get_clean();
        $this->started = false;
    }

    public function flush($return = false) {
        if ($return) {
            return $this->buffer;
        } else {
            echo $this->buffer;
        }
    }
    
    public function __toString() {
        return $this->buffer;
    }

}