<?php

return array(
    'preload' => 'router,blogger,db',
    'components' => array(
        'router' => array(
            'class' => 'NRouter',
            'rules' => array(
                array(
                    'class' => 'NDefaultRouteRule'
                ),
            ),
        ),
        'blogger' => array(
            'class' => 'ZendGdataBloggerSupport',
            'user' => 'krillzip@gmail.com',
            'password' => 'vwkhcgvhppeazind',
            'blogId' => 23186900,
        ),
        'db' => array(
            'class' => 'DatabaseConnection',
            'dsn' => 'mysql:host=localhost;dbname=blogger',
            'user' => 'blogger',
            'password' => 'ZHhXudzVf9AtELFT',
        ),
    ),
);