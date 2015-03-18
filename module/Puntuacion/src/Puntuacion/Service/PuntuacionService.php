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
use Puntuacion\Model\Entity\PuntuacionEncargados;
use Puntuacion\Model\Entity\CuotaFamily;
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

    protected function getMapperEnc(){
        $mapper = $this->getServiceManager()->get('puntuacion_encargados_mapper');
        return $mapper;
    }

    protected function getMapperCuotaF(){
        $mapper = $this->getServiceManager()->get('cuota_f_mapper');
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

    public function setPuntosToUser($data){
        $mapper = $this->getMapper();
        if(!$mapper->exists($data['user_id'], $data['mes'])){
            $puntuacion = new Puntuacion();

            $puntuacion->setUserId($data['user_id'])
                       ->setMes($data['mes'])
                       ->setCuota($data['cuota'])
                       ->setVenta($data['venta'])
                       ->setPuntos($data['puntos'])
                       ->setRegDate($data['reg_date'])
                       ->setStatus($data['status']);

            return $mapper->insert($puntuacion);
        }
        return false;
    }

    public function setPuntosToParent($data){
        $mapper = $this->getMapperEnc();

        if(!$mapper->exists($data['user_id'], $data['mes'])){
            $puntuacion = new PuntuacionEncargados();

            $puntuacion->setUserId($data['user_id'])
                       ->setMes($data['mes'])
                       ->setPuntos($data['puntos'])
                       ->setRegDate($data['reg_date'])
                       ->setStatus($data['status']);

            return $mapper->insert($puntuacion);
        }
        return false;
    }

    public function getCuotas($user){
        $mapper = $this->getMapperCuotaF();

        $cuotas = $mapper->getCuotasByUser($user);
        return $cuotas;
    }

}