<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Participantes' => __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    'controllers' => array(
        'invokables' => array(
            'Participantes' => 'Participantes\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'participantes' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/admin-usuarios[/:action][/:id]',
                    'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                    'defaults' => array(
                        'controller' => 'Participantes',
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