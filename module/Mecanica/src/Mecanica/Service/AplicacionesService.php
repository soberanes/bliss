<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mecanica\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Mecanica\Service\AbstractMethods;

class AplicacionesService extends AbstractMethods implements ServiceManagerAwareInterface {
	/**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var adapter
     */
    protected $adapter;

    /**
     * Set the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Uploader\Service\Acumulacion
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Get the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Mecanica\Service\Acumulacion
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }
    
    /**
     * Process data from loaded file
     * 
     * @param object $dataLoadedObj        
     * @return type boolean
     */
    public function processFile($data, $filename){
        date_default_timezone_set('America/Mexico_City');

        $userService        = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $userProfileService = $this->getServiceManager()->get('user_profile_service');

        $user_id = $data['user'];
        $month   = $data['month'];
        $sucursal = $userProfileService->getUserInfoProfile($user_id)->getSucursal();

        $sheetData = $this->getFileData($filename);

        /* PENDIENTE: ASIGNAR PUNTOS POR PRODUCTO APLICACIÓN */
        $this->_predump($sheetData);
    }

}