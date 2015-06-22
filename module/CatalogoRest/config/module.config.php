<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CatalogoRest\Controller\CatalogoRest' => 'CatalogoRest\Controller\CatalogoRestController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'catalogo-rest' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/catalogo-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'CatalogoRest\Controller\CatalogoRest',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);