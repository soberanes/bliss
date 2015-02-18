<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cscore\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Predicate\Expression as Expr;
use Cscore\Model\Entity\Creditsperiods as Creditsperiods;
class CreditsperiodsTable extends AbstractTableGateway{
    
    /**
     * nombre de tabla
     * @var type 
     */
    protected $table  = 'credits_periods';
    
    /**
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    /**
     * Constructor
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('id ASC');
                });

        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = new Creditsperiods();            
            $entity->setId($row->id);
            $entity->setIdperiod($row->id_period);
            $entity->setIdusername($row->id_username);
            $entity->setCredits($row->credits);
            $map= array(
                'id'=>$entity->getId(),
                'id_period'=>$entity->getIdperiod(),
                'id_username'=>$entity->getIdusername(),
                'credits'=>$entity->getCredits()
            ); 
            $entities[] = $map;
        }
        return $entities;
    }
    
    /**
     * Busca un Especifico ID
     * 
     * @param type $id
     * @return type
     */
    public function findId($id){
        $resultSet = $this->select(function (Select $select) use ($id){
                    $select->where(array('id' => $id));
                });
            $entity = new Creditsperiods();   
            $row = $resultSet->current();
            $entity->setId($row->id);
            $entity->setName($row->name);
            $entity->setFromdate($row->from_date);
            $entity->setTodate($row->to_date);
            $entities= array(
                'id'=>$entity->getId(),
                'name'=>$entity->getName(),
                'from_date'=>$entity->getFromdate(),
                'to_date'=>$entity->getTodate()
            ); 

        return $entities;    
    } 
    
    /**
     * Busca por ID y retorna nombre
     * 
     * @param type $id
     * @return type
     */
    public function getNameById($id){
        $name = null;
        $resultSet = $this->select(function (Select $select) use ($id){
                    $select->where(array('id' => $id));
                });  
        if($resultSet->count()>0){
            $entity = new Creditsperiods();         
            $row = $resultSet->current(); 
            $entity->setName($row->name);  
            $name = $entity->getName();
        } 
        return $name;
    }
    
    /**
     * Obtiene ID de periodo
     * 
     * @return type
     */
    public function getIdPeriodNow(){ 
        $id=0;
        $resultSet = $this->select(function (Select $select){
            $date = new \DateTime('now', new \DateTimeZone('America/Mexico_City'));
            $now = $date->getTimestamp();            
            $select->where(new Expr('from_date <= ?', $now));
            $select->where(new Expr('to_date >= ?', $now));
        });
        if($resultSet->count()>0){
            $entity = new Creditsperiods();
            $row = $resultSet->current();
            $entity->setId($row->id);
            $id = $entity->getId();
        }
        return $id; 
    }
}
