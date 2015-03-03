<?php

namespace Mecanica;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'products_table' => function($sm) {
                    $dbAdapter = $sm->get('db');
                    $table = new Model\ProductsTable($dbAdapter);
                    return $table;
                },
                'cuotas_table' => function($sm) {
                    $dbAdapter = $sm->get('db');
                    $table = new Model\CuotasTable($dbAdapter);
                    return $table;
                },
                'mecanica_acumulacion'=> function($sm){
                    $marketing = new \Mecanica\Service\AcumulacionService;
                    $marketing->setServiceManager($sm);
                    return $marketing;
                },
            ),
        );
    }

}
