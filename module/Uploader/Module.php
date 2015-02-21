<?php

namespace Uploader;

use Zend\ModuleManager\ModuleManager;

class Module {

    // 018002880030
    public function init(ModuleManager $mm) {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__, 'dispatch', function($e) {
            $e->getTarget()->layout('layout/registro');
        });
    }

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
                'uploader_form' => 'Uploader\Form\Uploader',
                'uploader_service' => 'Uploader\Service\UploadFileService',
            ),
            'factories' => array(
                'Uploader/Model/ModArchivosDao' => function($sm) {
                    $mapper = new Model\Mapper\ModArchivosDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\ModArchivos());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Uploader\Model\Entity\ModArchivosInterface'));
                    return $mapper;
                },
                'Uploader/Model/DataLoadedDao' => function($sm) {
                    $mapper = new Model\Mapper\DataLoadedDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\DataLoaded());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Uploader\Model\Entity\DataLoadedInterface'));
                    return $mapper;
                }
            )
        );
    }

}
