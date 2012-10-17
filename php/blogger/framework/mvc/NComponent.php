<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NComponent
 *
 * @author krillzip
 */
class NComponent {

    public function __get($name) {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return call_user_func(array($this, $method));
        } else {
            throw new Exception('Method "' . $method . '" doesn\'t exist on this object.');
        }
    }

    public function __set($name, $value) {
        $method = 'set' . ucfirst($name);
        if (method_exists($this, $method)) {
            call_user_func(array($this, $method), $value);
        } else {
            throw new Exception('Method "' . $method . '" doesn\'t exist on this object.');
        }
    }

}
