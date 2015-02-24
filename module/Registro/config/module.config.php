<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Registro' => __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    'controllers' => array(
        'invokables' => array(
            'Registro' => 'Registro\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'registro' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/registro[/:action]',
                    'defaults' => array(
                        'controller' => 'Registro',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
            'success' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/success',
                    'defaults' => array(
                        'controller' => 'Registro',
                        'action'     => 'success',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
            'complete' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/complete',
                    'defaults' => array(
                        'controller' => 'Registro',
                        'action'     => 'complete',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
        ),
    ),
);