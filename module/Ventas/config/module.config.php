<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Ventas' => __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    'controllers' => array(
        'invokables' => array(
            'Ventas' => 'Ventas\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'ventas' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/registro-ventas[/:action]',
                    'defaults' => array(
                        'controller' => 'Ventas',
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