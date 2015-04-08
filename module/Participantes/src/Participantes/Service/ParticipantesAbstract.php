<?php

namespace Participantes\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class ParticipantesAbstract {

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
     * @return \Uploader\Service\ProcessFile
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Get Adapter
     * 
     * @return type
     */
    public function getAdapter() {
        if (!$this->adapter) {
            $sm = $this->getServiceManager();
            $this->adapter = $sm->get('db');
        }
        return $this->adapter;
    }

    public function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }

    public function insertParticipant($data){
        $user_profile_service = $this->getServiceManager()->get("user_profile_service");
        
        $parent = (int) $data["parent"];

        $user_created = $user_profile_service->createUser($data, $parent);
        return $user_created;
    }

    public function updateParticipant($data){
        $user_profile_service = $this->getServiceManager()->get("user_profile_service");

        $parent = (int) $data["parent"];
        $user = $user_profile_service->updateUserInfo($data, $parent);
        return $user;
    }

    public function deleteParticipant($user_id){
        $user_profile_service = $this->getServiceManager()->get("user_profile_service");

        $delete = $user_profile_service->deleteUser($user_id);
        return $user;
    }
}