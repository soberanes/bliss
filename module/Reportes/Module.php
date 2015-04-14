<?php

namespace Reportes;

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
                'reporte_service'=> function($sm){
                    $service = new \Reportes\Service\ReporteService;
                    $service->setServiceManager($sm);
                    return $service;
                },
                'canjes_service'=> function($sm){
                    $service = new \Reportes\Service\CanjeService;
                    $service->setServiceManager($sm);
                    return $service;
                },
                'Reportes\Model\UserTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\UserTable($dbAdapter);
                    return $table;
                },
                'Reportes\Model\ComprasTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\ComprasTable($dbAdapter);
                    return $table;
                },
                'Reportes\Model\OrderTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\OrderTable($dbAdapter);
                    return $table;
                },
            )
        );
    }

}
