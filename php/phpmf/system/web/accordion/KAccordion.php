<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KAccodion
 *
 * @author krillzip
 */
class KAccordion extends KPaneCollection{
    public function __construct($begin = true)
    {
        parent::__construct($begin);
    }

    protected function assets()
    {
        return array(
            'css'=>array(
                'system.web.accordion.kaccordion'
            ),
            'js'=>array(
                'system.rez.js.prototype',
                'system.rez.js.scriptaculous.effects',
                'system.web.accordion.kaccordion'
            ),
        );
    }

    protected function view()
    {
        return 'system.web.accordion.kaccordion';
    }

    public static function start()
    {
        return new KAccordion(true);
    }
}
?>
