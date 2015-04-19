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

	public function getUserData($user){
		$adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
		
		$select->from("user_info")
		       ->join("sucursales","sucursales.sucursal_id = user_info.sucursal",array("sucursal_nombre" => "nombre"))
			   ->join("distribuidores","distribuidores.distribuidor_id = sucursales.distribuidor",array("distribuidor_nombre"=>"nombre"))
			   ->where(array("user_info.user_id" => $user));
		
		//echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        $data = (object) $resultSet = $statement->execute()->current();
        
        return $data;
	} 

	public function getCuentasReport(){
		$adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
		
		$select->from("user")
			   ->join("roles","roles.id = user.gid",array("perfil"=>"role"))
			   ->join("user_control","user_control.user_id = user.user_id",array("pwd"=>"password_text"))
			   ->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('gid NOT IN (?)',
                            array("1,4")));
		
		//echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
	}
	
	public function getFamilias(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        
        $select->from("familias");
        
        //echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    public function getCuotaTotalFamilia($familia, $cat, $user){
		$adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
		
        $table = ($cat == 1) ? "user_cuota_f" : "user_cuota_a";

		$select->from($table)
               ->where(array($table.".familia_id" => $familia, $table.".usuario_id" => $user));
		
		// echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        $data = (object) $resultSet = $statement->execute();
        $cuota_f = 0;
        $venta_f = 0;

        foreach ($data as $key => $value) {
            $cuota_f += $value["cuota"];
        }

        return $cuota_f;
	}

    public function getCumplimiento($user, $cat, $familia){
        $adapter = $this->getAdapter();
        
        $table = ($cat == 1) ? "user_cuota_f" : "user_cuota_a";

        $sql = "select (sum(puntuacion.venta)*100)/sum(".$table.".cuota) as cumplimiento
                from ".$table." 
                left join puntuacion on puntuacion.cuota = ".$table.".cuota_id
                inner join familias on familias.familia_id = ".$table.".familia_id
                where ".$table.".usuario_id = ".$user." and user_cuota_f.familia_id = ".$familia;
        
        $statement = $adapter->query($sql);
        $data = $resultSet = $statement->execute()->current();
        
        return (int) $data["cumplimiento"];
    }

    public function getVentaAnual($user){
        $adapter = $this->getAdapter();

        $sql = "SELECT sum(puntuacion.venta) as v_anual
                FROM puntuacion 
                WHERE puntuacion.user_id = ".$user;

        $statement = $adapter->query($sql);
        $data = $resultSet = $statement->execute()->current();
        
        return (int) $data["v_anual"];
    }

    public function getPuntos($user){
        $core_service_cmf_credits = $this->getServiceManager()
                ->get('core_service_cmf_credits');
        $creditsHistory = $core_service_cmf_credits->getCredits()
                ->getCreditHistoryByIdUser($user);
        $i = 0;
        foreach ($creditsHistory as $value) {
            $name = $core_service_cmf_credits->getCredits()
                        ->getCreditsperiodsNameById($value['id_period']);
            $creditsHistory[$i]['name_period'] = $name;
            ++$i;
        }

        $credits_history_table = $this->getServiceManager()
                ->get('Application\Model\CreditshistoryTable');

        $user_credit_history = $credits_history_table->findAllById(array(
            'where' => array('id_username' => $user),
            'order' => 'id ASC'
        ));
        
        // puntos gastados
        $order_table = $this->getServiceManager()->get('Cscore\Model\OrderTable');
        $total_orders = (int) $order_table->getTotalOrders($user)->total;

        // obtener el total de los puntos asignados 
        $credits = 0;
        $payments = 0;
        foreach ($user_credit_history as $credit_history) {
            $credits += $credit_history['credits'];
            $payments += $credit_history['payments'];
        }

        // obtener los puntos actuales
        $credits_table = $this->getServiceManager()->get('Application\Model\CreditsTable');
        $current_credit = $credits_table->fetchOneById(array(
            'where' => array('user_id' => $user),
            'order' => 'id ASC'
        ));


        $current_c_credit = (isset($current_credit['credit'])) ? $current_credit['credit'] : 0;
        
        $credit = array(
            'total' => $credits,
            'canjeados' => $payments,
            'ganados' => $total_orders + $current_c_credit,
            'actuales' => $current_c_credit
        );

        return (object) $credit;
    }

    public function getUserControl($user){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        
        $select->from("user_control")
               ->where(array("user_id" => $user));
        
        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return (object) $resultSet = $statement->execute()->current();
    }

    public function getDivisionCuota($a, $b) {         
        if($b === 0)
          return 0;

        return round(($a*100)/$b,2);
    }
	   
}