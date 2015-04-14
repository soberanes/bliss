<?php

namespace Reportes\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class CanjeService implements ServiceManagerAwareInterface {

    protected $serviceManager;

    /**
     * Reporte de usuarios con join de tablas
     */
    public function usuarios() {
        $userTable = $this->get('Reportes\Model\UserTable');
        return $userTable->getUsuariosJoin();
    }

    /**
     * Reporte de objetivos
     */
    public function objetivos() {
        $comprasTable = $this->get('Reportes\Model\ComprasTable');
        $compras = $comprasTable->getObjetivos();
        return $compras;
    }
    /**
     * Reporte de canjes
     */
    public function canjes() {
        $canjesTable = $this->get('Reportes\Model\OrderTable');
        $canjes = $canjesTable->getOrderlist();
        return $canjes;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    private function get($serviceName) {
        return $this->getServiceManager()->get($serviceName);
    }

}
