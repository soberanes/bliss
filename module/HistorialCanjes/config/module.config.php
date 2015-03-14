<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'HistorialCanjes\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'HistorialCanjes\Controller\Index' => 'HistorialCanjes\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'historial' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/historial[/:page]',
                            'defaults' => array(
                                'controller' => 'HistorialCanjes\Controller\Index',
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
