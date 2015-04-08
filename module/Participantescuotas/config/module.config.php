<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Participantescuotas' => __DIR__ . '/../view',
        ),
    ),
    'strategies' => array(
        'ViewJsonStrategy',
    ),
    'controllers' => array(
        'invokables' => array(
            'Participantescuotas' => 'Participantescuotas\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'cuotas' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/cuotas[/:action][/:id]',
                    'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                    'defaults' => array(
                        'controller' => 'Participantescuotas',
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