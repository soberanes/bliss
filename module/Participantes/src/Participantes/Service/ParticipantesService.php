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


class ParticipantesService {

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



}