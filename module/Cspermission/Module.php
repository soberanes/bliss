<?php
namespace Cspermission;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
class Module
{
    public function onBootstrap(MvcEvent $e)    {        
        $application = $e->getApplication();        
        $services    = $application->getServiceManager(); 
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $eventManager->attach('dispatch', array($this, 'loadConfiguration'),101);        

    }
    
    public function loadConfiguration(MvcEvent $e){
        $e->getApplication()->getServiceManager()
          ->get('ControllerPluginManager')->get('Permission')->doPermission($e);        
    }
    
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
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'Cspermission\Model\RolesTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\RolesTable($dbAdapter);
                    return $table;
                },
                'Cspermission\Model\ResourceTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\ResourceTable($dbAdapter);
                    return $table;
                },
                'Cspermission\Model\PermissionsTable' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new Model\PermissionsTable($dbAdapter);
                    return $table;
                },                        
            ),
        );
    }    
}
