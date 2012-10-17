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
class NView {

    public static function render($view, array $params = array(), $return = false) {
        if (!(file_exists($view) && is_readable($view))) {
            throw new NViewException('View "' . $view . '" doesn\'t exist or is not readable', NViewException::ILLEGAL_VIEW_PATH);
        }
        if ($return) {
            $clip = NClip::start();
            self::doRender($view, $params);
            $clip->end();
            return $clip;
        } else {
            self::doRender($view, $params);
        }
    }

    protected function doRender($_view_, $_params_) {
        extract($_params_);
        include $_view_;
    }

}

class NViewException extends Exception {

    const ILLEGAL_VIEW_PATH = 1;

}