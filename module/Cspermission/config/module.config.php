<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'permisiondeny' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'permisiondeny' => 'Cspermission\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'permisiondeny' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/deny',
                    'defaults' => array(
                        'controller' => 'permisiondeny',
                        'action'     => 'deny',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
        ),
    ),
);