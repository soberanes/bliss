<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Sucursales' => __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    'controllers' => array(
        'invokables' => array(
            'Sucursales'     => 'Sucursales\Controller\IndexController',
            'Distribuidores' => 'Sucursales\Controller\DistController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'sucursales' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/admin-sucursales[/:action][/:id]',
                    'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                    'defaults' => array(
                        'controller' => 'Sucursales',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(             
                ),
            ),
            'distribuidores' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/admin-distribuidores[/:action][/:id]',
                    'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                    'defaults' => array(
                        'controller' => 'Distribuidores',
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