<?php

namespace Puntuacion;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'puntuacion_mapper' => function($sm) {
                    $mapper = new Model\Mapper\PuntuacionDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\Puntuacion());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Puntuacion\Model\Entity\PuntuacionInterface'));
                    return $mapper;
                },
                'puntuacion_encargados_mapper' => function($sm) {
                    $mapper = new Model\Mapper\PuntuacionEncargadosDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\PuntuacionEncargados());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Puntuacion\Model\Entity\PuntuacionEncargadosInterface'));
                    return $mapper;
                },
                'cuota_f_mapper' => function($sm) {
                    $mapper = new Model\Mapper\CuotaFamilyDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\CuotaFamily());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Puntuacion\Model\Entity\CuotaFamilyInterface'));
                    return $mapper;
                },
                'puntuacion_service'=> function($sm){
                    $puntuacion_srv = new \Puntuacion\Service\PuntuacionService;
                    $puntuacion_srv->setServiceManager($sm);
                    return $puntuacion_srv;
                },
            ),
        );
    }

}