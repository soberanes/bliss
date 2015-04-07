<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Reportes\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Parameters;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class ReporteService {

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
	
	public function getVentasReport(){
		$adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
		
		$select->from("puntuacion")
               ->join("user","user.user_id = puntuacion.user_id",array("userid"=>"user_id"))
			   ->join("roles","roles.id = user.gid", array("figura"=>"role"))
			   ->join("user_info","user_info.user_id = puntuacion.user_id",array("nombre"=>"fullname"))
			   ->join("sucursales","sucursales.sucursal_id = user_info.sucursal", array("sucursal"=>"nombre"),"left")
			   ->join("distribuidores","distribuidores.distribuidor_id = sucursales.distribuidor",array("distribuidor"=>"nombre"),"left")
			   ->join("user_cuota_f","user_cuota_f.cuota_id = puntuacion.cuota",array("cuota_id"=>"cuota_id"),"left")
			   ->join("familias","familias.familia_id = user_cuota_f.familia_id",array("familia"=>"nombre"),"left");
		
		//echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
	}
	
}