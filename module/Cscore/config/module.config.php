<?php
return array(
    'view_helpers' => array(
        'factories' => array(
                'Categoryhelper' => function($sm){
                    $helper = new \Cscore\View\Helper\Categoryhelper;
                    $sl = $sm->getServiceLocator();
                    $helper->setSm($sl);                
                    return $helper;
                }
        )
    ),     
);