<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Participantes\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Parameters;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Participantes\Service\ParticipantesAbstract;

class ParticipantesService extends ParticipantesAbstract {

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
            $this->adapter = $sm->get('db');
        }
        return $this->adapter;
    }

    public function getParticipanteById($id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();

        $select->from('user')
               ->columns(array(
                            'user_id'   => 'user_id',
                            'username'  => 'username',
                            'parent_id' => 'parent',
                            'parent'    => new Expression('(select fullname from user_info where user_id = parent_id)'),
                        ))
               ->join('roles','roles.id = user.gid', array('perfil' => 'id'))
               ->join('user_info','user_info.user_id = user.user_id', 
                            array(
                                'fullname'  => 'fullname', 
                                'email'     => 'email',
                                'phone'     => 'phone',
                                'cellphone' => 'cellphone',
                                'domicilio' => 'address',
                                'municipio' => 'municipio',
                                'zipcode'   => 'zip_code',
                                'estado'    => 'estado',
                                'birthdate' => 'birthdate',
                                'status'    => 'status'
                            ))
               ->join('sucursales','user_info.sucursal = sucursales.sucursal_id', array('sucursal_id' => 'sucursal_id'))
               ->where(array(
                    "user_info.user_id" => $id
                ));

        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return (object) $resultSet = $statement->execute()->current();
    }

    public function getParticipantes($ids = null){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();

        $select->from('user')
               ->columns(array(
                            'user_id'   => 'user_id',
                            'username'  => 'username',
                            'parent_id' => 'parent',
                            'parent'    => new Expression('(select fullname from user_info where user_id = parent_id)'),
                        ))
               ->join('roles','roles.id = user.gid', array('role' => 'role'))
               ->join('user_info','user_info.user_id = user.user_id', 
                            array(
                                'fullname' => 'fullname', 
                                'email' => 'email', 
                                'status' => 'status'
                            ))
               ->join('sucursales','user_info.sucursal = sucursales.sucursal_id', array('sucursal' => 'nombre'));

        if($ids){
            $select->where(array(
                "user_info.sucursal" => $ids
            ));
        }

        $select->where(array(
                "user_info.status" => array(1,-2)
            ));

        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    public function searchParticipante($text){
        $distribuidor_id = $this->getDistribuidorByName($text);
        $sucursales_ids = $this->getSucursalesIdsByDistribuidor($distribuidor_id);
        
        return $this->getParticipantes($sucursales_ids);
    }

    public function getSucursalesIdsByDistribuidor($distribuidor_id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('sucursales')
               ->where(array('distribuidor' => $distribuidor_id));
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $sucursales_ids = array();

        foreach ($resultSet as $key => $value) {
            array_push($sucursales_ids, $value["sucursal_id"]);
        }

        return $sucursales_ids;
    }

    public function getDistribuidorByName($text){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('distribuidores')
               ->where->like('nombre', '%'.$text.'%');

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute()->current();
        return $resultSet["distribuidor_id"];
    }

    public function getEstadosOptions(){
        $dbAdapter = $this->getAdapter();

        $sql = 'SELECT t0.estado_id as id, t0.estado as name FROM estados t0 ORDER BY t0.estado ASC';
        
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['name'];
        }

        return $selectData;
    }

    public function getParentsOptions(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('user')
               ->join('user_info','user_info.user_id = user.user_id',array('fullname'))
               ->where(array('user.gid' => 3));

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();

        $selectData = array();

        foreach ($resultSet as $res) {
            $selectData[$res['user_id']] = $res['fullname'];
        }

        return $selectData;
    }

    public function getSucursalesOptions(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('sucursales')
               ->join('distribuidores','distribuidores.distribuidor_id = sucursales.distribuidor',array('distribuidor_name' => 'nombre'))
               ->order('sucursales.distribuidor ASC');

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();

        $selectData = array();

        foreach ($resultSet as $res) {
            $selectData[$res['sucursal_id']] = $res["distribuidor_name"]." - ".$res['nombre'];
        }

        return $selectData;
    }

    public function saveParticipante($data, $action = null){
        if($action == "update"){
            $statement = $this->updateParticipant($data);
        }else{
            $statement = $this->insertParticipant($data);
        }

        return $statement;
    }

    public function deleteParticipante($participante_id){
        $statement = $this->deleteParticipant($participante_id);
        return $statement;
    }


}