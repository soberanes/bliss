<?php
namespace Cscore;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig(){
        return array(
            'factories' => array(
                'Cscore\Model\CartTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\CartTable($dbAdapter);
                    return $table;
                },
                'core_service_cmf_cart'=>  function ($sm){
                    $cmf = new \Cscore\Service\Cmf;
                    $cmf->setServiceManager($sm);
                    return $cmf;
                }, 
                'Cscore\Model\CategoryTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\CategoryTable($dbAdapter);
                    return $table;
                },
                'core_service_cmf_category'=>  function ($sm){
                    $cmf = new \Cscore\Service\Cmf;
                    $cmf->setServiceManager($sm);
                    return $cmf;
                },   
                'Cscore\Model\OrderTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\OrderTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\OrderhistoryTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\OrderhistoryTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\OrderitemTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\OrderitemTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\OrderstatusTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\OrderstatusTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\PaymentTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\PaymentTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\PaymentmethodTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\PaymentmethodTable($dbAdapter);
                    return $table;
                },
                'core_service_cmf_checkout'=>function($sm){
                    $cmf = new \Cscore\Service\Cmf;
                    $cmf->setServiceManager($sm);
                    return $cmf;
                },
                'Cscore\Model\CreditsTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\CreditsTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\CreditshistoryTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\CreditshistoryTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\CreditsperiodsTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\CreditsperiodsTable($dbAdapter);
                    return $table;
                }, 
                'core_service_cmf_credits'=>  function ($sm){
                    $cmf= new \Cscore\Service\Cmf;
                    $cmf->setServiceManager($sm);
                    return $cmf;
                }, 
                'core_service_cmf_user'=>function($sm){
                    $cmf = new \Cscore\Service\Cmf;
                    $cmf->setServiceManager($sm);
                    return $cmf;
                }, 
                'Cscore\Model\ProductTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\ProductTable($dbAdapter);
                    return $table;
                },
                'Cscore\Model\ProductpriceTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\ProductpriceTable($dbAdapter);
                    return $table;
                },
                'core_service_cmf_product'=>  function ($sm){
                    $cmf = new \Cscore\Service\Cmf;
                    $cmf->setServiceManager($sm);
                    return $cmf;
                },
                'Cscore\Model\ProductcategoryTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\ProductcategoryTable($dbAdapter);
                    return $table;
                }, 
            )    
        );
    }     
}
