<?php

namespace Sucursales;

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
                'sucursales_service'=> function($sm){
                    $registro = new \Sucursales\Service\SucursalesService;
                    $registro->setServiceManager($sm);
                    return $registro;
                },
                'distribuidores_service'=> function($sm){
                    $registro = new \Sucursales\Service\DistribuidoresService;
                    $registro->setServiceManager($sm);
                    return $registro;
                }
            )
        );
    }

}
