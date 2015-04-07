<?php

namespace Participantes;

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
                'participantes_service'=> function($sm){
                    $service = new \Participantes\Service\ParticipantesService;
                    $service->setServiceManager($sm);
                    return $service;
                }
            )
        );
    }

}
