<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cshelperzfcuser\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Cshelperzfcuser\Model\Entity\UserInfo as UserInfo;
use Zend\Db\Adapter\Adapter;

class UserService {

	/**
     * @var ServiceManager
     */
    protected $serviceManager;
	
	protected $adapter;

    /**
     * Get Service Manager
     * 
     * @return type
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Inject Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Inject Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return Service
     */
    public function get($param) {
        return $this->getServiceManager()->get($param);
    }

    /**
     * Get Adapter
     * 
     * @return type
     */
    public function getAdapter(){
        if(!$this->adapter){
            $sm = $this->getServiceManager();
            $this->adapter = $sm->get('db1');
        }
        return $this->adapter;
    }

    /**
	 * Getting user info profile
	 *
	 * @param Int $userId
	 * @return Entity
     */
	public function getUserInfo($userId) {
		$mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoProfile');
		
		$userInfo = $mapper->getUserInfoProfile($userId);
		// $userInfo = $mapper->fetchAll();
		return $this->checkProfile($userInfo);
	}

	/**
	 * Checking if the profile is completed
	 *
	 * @param Int $userId
	 * @return Boolean
     */
	public function checkProfile($user) {
        if( $user->getStatus() == -2 ){
            return false;
        }

        return true;
	}

    /**
     * Save the user info into user_info's table 
     * 
     * @param array $data
     * @param int $userId
     * @return boolean
     */
    public function saveUserInfo($data, $user_id, $profile) {
        date_default_timezone_set('America/Mexico_City');
        $entity = new UserInfo($data);
        
        $entity->setUserInfoAdicionalId($user_id)
        	   ->setUserId($user_id)
               ->setRazonSocial($data['razon_social'])
               ->setNombre($data['nombre'])
               ->setDomicilio($data['domicilio'])
               ->setEstadoId($data['estado'])
               ->setCpId($data['cp'])
               ->setTelefono($data['telefono'])
               ->setCelular($data['celular'])
               ->setEmail($data['email'])
               ->setCreationDate(strtotime(date('d-m-Y')))
               ->setLastUpdate(strtotime(date('d-m-Y')))
               ->setStatus(1);

        if($profile == 3){
            $entity->setNombreDistribuidor($data['nombre_distribuidor'])
                   ->setNombreVendedor($data['nombre_vendedor']);
        }

        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoDao');
        $newEntity = $mapper->saveUser($entity);
        if (null !== $newEntity) {
            if ($newEntity->getUserInfoAdicionalId() !== null &&
                    $newEntity->getUserInfoAdicionalId() !== 0) {
                return true;
            }
        }
        return false;
    }

	public function getSelectOptions(){
		$dbAdapter = $this->getAdapter();
        $sql       = 'SELECT t0.estado_id, t0.nombre FROM cat_estados t0 ORDER BY t0.nombre ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();
 
        $selectData = array();
 
        foreach ($result as $res) {
            $selectData[$res['estado_id']] = $res['nombre'];
        }
 
        return $selectData;
	}

}
