<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Participantescuotas\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Parameters;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class CuotasService {

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

    /**
     * Obtiene cuotas de las familias de usuario
     * 
     * @return type
     */
    public function getCuotasForParticipantF($user_id){
    	$adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();

        $select->from('user_cuota_f')
        	   ->join('familias', 'familias.familia_id = user_cuota_f.familia_id', array('familia'=>'nombre'))
        	   ->where(array('user_cuota_f.usuario_id'=>$user_id))
        	   ->order('user_cuota_f.mes ASC');

       	$statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    /**
     * Obtiene cuotas de las aplicaciones de usuario
     * 
     * @return type
     */
    public function getCuotasForParticipantA($user_id){
    	$adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();

        $select->from('user_cuota_a')
        	   ->join('familias', 'familias.familia_id = user_cuota_a.familia_id', array('familia'=>'nombre'))
        	   ->where(array('user_cuota_a.usuario_id'=>$user_id))
        	   ->order('user_cuota_a.mes ASC');

       	$statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    public function saveCuota($data){
    	$adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $cuota_id  = $data["cuota_id"];
        $cuota_val = $data["cuota_data"];
        $reference = $data["ref"];

        if(is_numeric($cuota_val)){

        	$table = ($reference == "familias") ? "user_cuota_f" : "user_cuota_a";

        	$new_data = array(
        		"cuota" => $cuota_val
        	);

    		$update = $sql->update();
            $update->table($table)->set($new_data)->where(array('cuota_id' => $cuota_id));
            $statement = $sql->prepareStatementForSqlObject($update);
            $resultSet = $statement->execute();
        	
        	return true;
        }

        return false;
    }

    public function getMonths(){
    	$months_txt = array(
    		1  => "Enero",
    		2  => "Febrero",
    		3  => "Marzo",
    		4  => "Abril",
    		5  => "Mayo",
    		6  => "Junio",
    		7  => "Julio",
    		8  => "Agosto",
    		9  => "Septiembre",
    		10 => "Octubre",
    		11 => "Noviembre",
    		12 => "Diciembre",
    	);

    	return $months_txt;
    }
}