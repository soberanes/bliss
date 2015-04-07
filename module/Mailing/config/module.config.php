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
);
