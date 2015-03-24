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

    public function getPuntosEnc($user, $month){
        $mapper = $this->getMapperEnc();
        $puntuacion = $mapper->getPuntosByUser($user, $month);
        if($puntuacion){
            return $puntuacion->getPuntos();
        }
        return 0;
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
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        // die;
        $mapper = $this->getMapper();
        $puntuacion = new Puntuacion();
        
        $puntuacion->setUserId($data['user_id'])
                   ->setMes($data['mes'])
                   ->setCuota($data['cuota_id'])
                   ->setVenta($data['venta'])
                   ->setPuntos($data['puntos'])
                   ->setRegDate($data['reg_date'])
                   ->setStatus($data['status']);

        $exists = $mapper->exists($data['user_id'], $data['mes'], $data['cuota_id']);
        
        if($exists){
            $puntuacion->setPuntuacionId($exists->getPuntuacionId());
            return $mapper->update($puntuacion);
        }
        return $mapper->insert($puntuacion);
    }

    public function setPuntosToParent($data){
        $mapper = $this->getMapperEnc();
        $puntuacion = new PuntuacionEncargados();

        $puntuacion->setUserId($data['user_id'])
                   ->setMes($data['mes'])
                   ->setPuntos($data['puntos'])
                   ->setRegDate($data['reg_date'])
                   ->setStatus($data['status']);

        $exists = $mapper->exists($data['user_id'], $data['mes']);

        if($exists){
            $puntuacion->setPuntuacionEncargadosId($exists->getPuntuacionEncargadosId());
            return $mapper->update($puntuacion);
        }
            return $mapper->insert($puntuacion);
    }

    public function getCuotas($user, $month){

        $mapper = $this->getMapperCuotaF();

        $cuotas = $mapper->getCuotasByUser($user, $month);
        return $cuotas;
    }

    public function getSales($user, $month){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        
        $userProfileService = $this->getServiceManager()->get('user_profile_service');
        $mapper = $this->getMapperCuotaF();

        $user_ids = $userProfileService->getUsersByParent($user);

        $select = $sql->select();
        $select->from('user_cuota_f')
               ->columns(array(
                    'usuario_id',
                    'cuota' => new Expression('SUM(user_cuota_f.cuota)'),
                    'mes',
                    'familia_id'
                ))
                ->join('puntuacion', 'puntuacion.cuota = user_cuota_f.cuota_id', 
                        array(
                            'puntos' => 'puntos', 
                            'venta' => new Expression('SUM(puntuacion.venta)')
                        ), 'left' )
                ->join('user_info', 'user_info.user_id = user_cuota_f.usuario_id', 
                        array('fullname' => 'fullname' ));
        $select->where(array('user_cuota_f.usuario_id' => $user_ids, 'user_cuota_f.mes' => $month))
               ->group('user_cuota_f.usuario_id');

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        
        return $this->toArray($resultSet);
    }

    public function toArray($args){
        $response = array();
        foreach ($args as $key => $value) {
            $response[$key] = $value;
        }
        return $response;
    }


}