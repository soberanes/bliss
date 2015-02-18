<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Cscart\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Cscart\Controller\Index' => 'Cscart\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cscart_controller_index' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/carrito[/:idtask]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Cscart\Controller\Index',
                        'action' => 'carrito',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
        ),
    ),
);