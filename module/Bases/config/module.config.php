<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Bases\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Bases\Controller\Index' => 'Bases\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'bases' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/bases[/:action]',
                    'defaults' => array(
                        'controller' => 'Bases\Controller\Index',
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