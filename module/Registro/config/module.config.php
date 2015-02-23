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
        ),
    ),
);