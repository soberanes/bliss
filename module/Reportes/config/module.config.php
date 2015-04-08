<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Reportes' => __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    'controllers' => array(
        'invokables' => array(
            'Reportes' => 'Reportes\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'reportes' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/reportes[/:action]',
                    'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                    'defaults' => array(
                        'controller' => 'Reportes',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
        ),
    ),
);