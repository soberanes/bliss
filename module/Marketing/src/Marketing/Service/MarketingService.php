<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketing\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\Container;
use Zend\Validator\File\Size;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class MarketingService implements ServiceManagerAwareInterface {

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

    public function getSucursalesData(){
    	$adapter = $this->getAdapter();

    	$sql = new Sql($adapter);
    	$select = $sql->select();
    	$select->from('data_loaded')
    		   ->columns(
    		   		array(
                        'data_loaded' => 'data_loaded_id',
    		   			'month' => 'month', 
    		   			'archivo_id' => 'archivo_id',
    		   			'dl_process_date' => 'process_date', 
    		   			'load_status' => 'status'
    		   		)
    		   	)
    		   ->join(
    		   		'user_info', 
    		   		'user_info.user_id = data_loaded.user_id',
    		   		array(
    		   			'user_id' => 'user_id', 
    		   			'email'   => 'email'
    		   		),
    		   		'left'
    		   	)
    		   ->join(
    		   		'sucursales', 
    		   		'sucursales.sucursal_id = user_info.sucursal',
    		   		array(
    		   			'sucursal_id' => 'sucursal_id', 
    		   			'sucursal_name' => 'nombre'
    		   		),
    		   		'right'
    		   	);
		
		$statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();

        $response = array();

        foreach ($resultSet as $key => $value) {
        	$response[$key] = $value;
        	$mod_archivos = $this->getArchivo($value["archivo_id"]);
        	array_push($response[$key], $mod_archivos);
        }
        	// echo "<pre>";
        	// var_dump($resultSet);
        	// echo "</pre>";
        	// die;
        return $response;
    }

    public function getArchivo($archivo_id){
    	$adapter = $this->getAdapter();
    	$sql = new Sql($adapter);
    	$select = $sql->select();
    	$select->from('mod_archivos')
    		   ->columns(
    		   		array(
    		   			'archivo_id' => 'archivo_id', 
    		   			'filename' => 'filename', 
    		   			'upload_date' => 'upload_date', 
    		   			'f_process_date' => 'process_date'
    		   		)
    		   	)
    		   	->where(array('archivo_id' => $archivo_id));
    	$statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $response = $resultSet->current();
        return $response;
    }

    public function getUserSucursal($user_id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('user_info')
                ->where(array('user_id' => $user_id));
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $response = $resultSet->current();
        return $response;
    }

    public function deactivateDataLoaded($data_loaded_id){
    	$adapter = $this->getAdapter();
        $data = array('status' => 3);

        $sql = new Sql($adapter);
        $update = $sql->update();
        $update->table('data_loaded')->set($data)->where(array('data_loaded_id' => $data_loaded_id));
        $statement = $sql->prepareStatementForSqlObject($update);
        $result    = $statement->execute();
        return $result;
    }

}