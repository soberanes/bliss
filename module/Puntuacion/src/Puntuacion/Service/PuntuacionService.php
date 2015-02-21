<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Puntuacion\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\Container;
use Zend\Validator\File\Size;
use Puntuacion\Model\Entity\Puntuacion;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class PuntuacionService implements ServiceManagerAwareInterface {

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

    protected function getMapper(){
        $mapper = $this->getServiceManager()->get('puntuacion_mapper');
        return $mapper;
    }

    /**
     * This method returns a the points by user
     *
     * @param String $limit
     * @return Array
     */
    public function getPuntosByUser($user, $month){
        $mapper = $this->getMapper();
        $puntuacion = $mapper->getPuntosByUser($user, $month);
        return $puntuacion;
    }

    public function getMonthLoaded($user){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('puntuacion')
               ->columns(array('last' => new Expression('MAX(mes)')))
               ->where(array(
                    'user_id' => $user
                ));
        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();

        return $resultSet->current();

    }




}