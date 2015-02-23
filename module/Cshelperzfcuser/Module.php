<?php

namespace Cshelperzfcuser;

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
            'factories' =>
            array(
                'Cshelperzfcuser\Model\Mapper\UserInfoDao' => function($sm) {
                    $mapper = new Model\Mapper\UserInfoDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\UserInfo());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\UserInfoInterface'));
                    return $mapper;
                },
                'Cshelperzfcuser\Model\Mapper\UserInfoLaboralDao' => function($sm) {
                    $mapper = new Model\Mapper\UserInfoLaboralDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\UserInfoLaboral());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\UserInfoLaboralInterface'));
                    return $mapper;
                },
                'Cshelperzfcuser\Model\Mapper\UserInfoAdicionalDao' => function($sm) {
                    $mapper = new Model\Mapper\UserInfoAdicionalDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\UserInfoAdicional());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\UserInfoAdicionalInterface'));
                    return $mapper;
                },
                'Cshelperzfcuser\Model\Mapper\UserInfoCandidatoDao' => function($sm) {
                    $mapper = new Model\Mapper\UserInfoCandidatoDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\UserInfoCandidato());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\UserInfoCandidatoInterface'));
                    return $mapper;
                },
                'Cshelperzfcuser\Model\Mapper\PreRegistroDao' => function($sm) {
                    $mapper = new Model\Mapper\PreRegistroDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\PreRegistro());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\PreRegistroInterface'));
                    return $mapper;
                },
                'Cshelperzfcuser\Model\Mapper\CatEstadosDao' => function($sm) {
                    $mapper = new Model\Mapper\CatEstadosDao();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\CatEstados());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\CatEstadosInterface'));
                    return $mapper;
                },
                'Cshelperzfcuser\Model\Mapper\UserInfoProfile' => function($sm) {
                    $mapper = new Model\Mapper\UserInfoProfile();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\UserInfo());
                    $mapper->setHydrator(new Model\Mapper\AbstractHydrator('\Cshelperzfcuser\Model\Entity\UserInfoInterface'));
                    return $mapper;
                },
                'user_profile_service'=> function($sm){
                	$user_profile = new \Cshelperzfcuser\Service\UserService;
                	$user_profile->setServiceManager($sm);
                	return $user_profile;
                }
            )
        );
    }

}
