<?php
return array(
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