<?php

return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Mecanicas\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Mecanicas\Controller\Index' => 'Mecanicas\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'mecanicas' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/mecanicas[/:action]',
                    'defaults' => array(
                        'controller' => 'Mecanicas\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                ),
            ),
        ),
    ),
);
