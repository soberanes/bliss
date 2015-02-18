<?php
/**
 * CookieShop
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Cscore\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Cscore\Model\Entity\Orderhistory as Orderhistory;
class OrderhistoryTable extends AbstractTableGateway{
    
    /**
     * nombre de tabla 
     * @var type 
     */    
    protected $table  = 'order_history';
    
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */    
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    /**
     * Lista todos los Items
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('order_id ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }
    
    /**
     * Lista todos los Items Relacionados por ID
     * 
     * @param type $id
     * @return type
     */
    public function findAllById($id) {
        $resultSet = $this->select(function (Select $select) use($id){
                    $select->where(array('order_id'=>$id));
                    $select->order('id ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }   
    
    /**
     * Lista un Item Relacionado a un ID
     * 
     * @param type $id
     * @return type
     */    
    public function fetchOneById($id) {
        $resultSet = $this->select(function (Select $select) use($id){
                    $select->where(array('order_id'=>$id));
                    $select->order('id ASC');
                });
        $entities = array();
        if(count($resultSet)===1){
            $row = $resultSet->current();
            $entity = $this->setEntity($row);
            $entities = $this->getEntities($entity);             
        }
        return $entities;
    }
    
    /**
     * Inserta una Orden
     * 
     * @param type $params
     * @return type
     */    
    public function insertHistory($params){
  
        $entity = new Orderhistory();
        $entity->setOrderid($params['order_history']['orde_id']);
        $entity->setOrderstatus($params['order_history']['order_status']);
        $entity->setOrderdate($params['order_history']['order_date']);
        $entity->setIp($params['order_history']['ip']); 
        $data = $this->getEntities($entity);
        $this->insert($data);
    }
    
    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Order
     */    
    public function setEntity($row){
        $entity = new Orderhistory();
        $entity->setOrderid($row->order_id);
        $entity->setOrderstatus($row->order_status);
        $entity->setOrderdate($row->order_date);
        $entity->setIp($row->ip);        
        return $entity;
    }
    
    /**
     * Obtiene tipos de datos a entidades
     * 
     * @param \Cscore\Model\Entity\Order $entity
     * @return type
     */    
    public function getEntities(Orderhistory $entity){
        $entities= array(
            'order_id'=>$entity->getOrderid(),
            'order_status'=>$entity->getOrderstatus(),
            'order_date'=>$entity->getOrderdate(),
            'ip'=>$entity->getIp()
        ); 
        return $entities;
    }
}