<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Cscheckout\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cscheckout\Controller\Index' => 'Cscheckout\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'Cscheckout\Controller\Index' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/checkout',
                    'defaults' => array(
                        'controller' => 'Cscheckout\Controller\Index',
                        'action'     => 'checkout',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
        ),
    ),
);