<?php

namespace Marketing;

class Module {

    // 018002880030

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
                'marketing_service'=> function($sm){
                    $marketing = new \Marketing\Service\MarketingService;
                    $marketing->setServiceManager($sm);
                    return $marketing;
                },
            )
        );
    }

}
