<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KDecorator
 *
 * @author krillzip
 */
class KDecorator extends KView
{
    public function __construct($layout, $view, $vars)
    {
        $clip = KClip::clip();
        KView::render($view, $vars);
        $vars['content'] = $clip->flush();
        parent::__construct($layout, $vars);
    }

    public static function layout($layout, $view, $vars)
    {
        $decorator = new KDecorator($layout, $view, $vars);
        unset($decorator);
    }
}
?>