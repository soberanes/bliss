<?php

namespace Registro;

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
            'invokables' => array(
                'complete_form' => '\Ventas\Form\Complete',
            ),
            'factories' => array(
                'registro_service'=> function($sm){
                    $registro = new \Registro\Service\RegistroService;
                    $registro->setServiceManager($sm);
                    return $registro;
                }
            )
        );
    }

}
