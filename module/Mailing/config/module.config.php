<?php

return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Mailing\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Mailing\Controller\Index' => 'Mailing\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'mailing' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/notifica',
                    'defaults' => array(
                        'controller' => 'Mailing\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'mail_options' => array(
        'host' => 'smtp.mandrillapp.com',
        'port' => 465, // Notice port change for TLS is 587
        'connection_class' => 'login',
        'connection_config' => array(
            'username' => 'liderproyectos2@logoline.com.mx',
            'password' => '63d81da3-ad93-431d-b3e6-105ecb766ad4',
            'ssl' => 'ssl',
        )
    ),
);
