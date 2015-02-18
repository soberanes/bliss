<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Cscurrencypoints\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cscurrencypoints\Controller\Index' => 'Cscurrencypoints\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'Cscurrencypoints\Controller\Index' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/currencypoint',
                    'defaults' => array(
                        'controller' => 'Cscurrencypoints\Controller\Index',
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