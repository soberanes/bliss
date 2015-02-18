<?php

namespace Mecanicas;

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
                'mecanica_acumulacion'         => 'Mecanicas\Service\Acumulacion',
                'mecanica_puntos_mayorista'    => 'Mecanicas\Service\PuntosMayorista',
                'mecanica_puntos_distribuidor' => 'Mecanicas\Service\PuntosDistribuidor',
            ),
            'factories' => array(
                'Mecanicas_Model_ProductosHomologadosTable' => function($sm) {
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\ProductosHomologadosTable($dbAdapter);
                    return $table;
                },
                'Mecanicas_Model_PuntosTable' => function($sm) {
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\PuntosTable($dbAdapter);
                    return $table;
                },
                'Mecanicas_Model_Products' => function($sm) {
                    $dbAdapter = $sm->get('db1');
                    $table = new Model\ProductsTable($dbAdapter);
                    return $table;
                },
            ),
        );
    }

}
