<?php

return array(
    'header'=>NConfig::import('nano.config.header'),
    'resources'=>array(
        'js'=>array(
            'jquery'=>'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js',
            'jqueryui'=>'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js',
        ),
        'css'=>array(
            'reset'=> array(
                'alias'=>'nano.web.rez.css.reset',
                'media'=>'screen',
            ),
            'typography'=> array(
                'alias'=>'nano.web.rez.css.typography',
                'media'=>'screen',
            ),
            'forms'=> array(
                'alias'=>'nano.web.rez.css.forms',
                'media'=>'screen',
            ),
            'grid'=> array(
                'alias'=>'nano.web.rez.css.grid',
                'media'=>'grid',
            ),
            'print'=>array(
                'alias'=>'nano.web.rez.css.print',
                'media'=>'print',
            ),
        ),
    ),
);