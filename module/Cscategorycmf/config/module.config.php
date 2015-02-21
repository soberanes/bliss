<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Cscategorycmf' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cscategorycmf' => 'Cscategorycmf\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'Cscategorycmf\Controller\Index' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/categories',
                    'defaults' => array(
                        'controller' => 'Cscategorycmf',
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