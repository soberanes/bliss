<?php

namespace Csproductcmf;

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
                'Csproductcmf\Model\PeriodoscanjeTable' => function($sm) {
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\PeriodoscanjeTable($dbAdapter);
                    return $table;
                },
            )
        );
    }

}
