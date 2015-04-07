<?php

return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Marketing\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Marketing\Controller\Index' => 'Marketing\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'marketing' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/marketing',
                    'defaults' => array(
                        'controller' => 'Marketing\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'notify-user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/notify-user',
                    'defaults' => array(
                        'controller' => 'Marketing\Controller\Index',
                        'action' => 'notifyUser',
                    ),
                ),
            ),
            'validate' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/validate',
                    'defaults' => array(
                        'controller' => 'Marketing\Controller\Index',
                        'action' => 'validate',
                    ),
                ),
            ),
            'download' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/download[/:file]',
                    'constraints' => array(
                         'file' => '[0-9]',
                     ),
                    'defaults' => array(
                        'controller' => 'Marketing\Controller\Index',
                        'action' => 'download',
                    ),
                ),
            ),
        ),
    ),
);
