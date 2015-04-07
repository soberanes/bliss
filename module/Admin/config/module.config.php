<?php

return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'admin-aplicaciones' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin-aplicaciones',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'aplicaciones',
                    ),
                ),
            ),
            'admin-upload' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin-upload',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'upload',
                    ),
                ),
            ),
        ),
    ),
);
