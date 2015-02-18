<?php
return array(
    'view_manager' => array(
        'template_path_stack' => array(
            'Csproductcmf\Controller\Index' => __DIR__ . '/../view',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Csproductcmf\Controller\Index' => 'Csproductcmf\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'csproductcmf_controller_index_index' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/productsc[/:cat][/:page]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]*'
                            ),
                            'defaults' => array(
                                'controller' => 'Csproductcmf\Controller\Index',
                                'action' => 'index',
                            ),
                        ),
                'may_terminate' => true,
                'child_routes' => array(                  
                ),
            ),
            'csproductcmf_controller_index_producto' => array(
                    'type' => 'Segment',
                        'options' => array(
                            'route' => '/articulo[/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'controller' => 'Csproductcmf\Controller\Index',
                                'action' => 'producto',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(                  
                        ),
            ),            
        ),
    ),     
);
