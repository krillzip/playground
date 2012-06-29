<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KTab
 *
 * @author krillzip
 */
class KTabs extends KPaneCollection{

    public function __construct($begin = true)
    {
        parent::__construct($begin);
    }

    protected function assets()
    {
        return array(
            'css'=>array(
                'system.web.tabs.ktabs'
            ),
            'js'=>array(
                'system.rez.js.prototype',
                'system.web.tabs.ktabs'
            ),
        );
    }
    
    protected function view()
    {
        return 'system.web.tabs.ktabs';
    }

    public static function start()
    {
        return new KTabs(true);
    }
}
?>