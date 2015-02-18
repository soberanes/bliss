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
use Cscore\Model\Entity\Order as Order;
class OrderTable extends AbstractTableGateway{
    /**
     * nombre de tabla 
     * @var type 
     */
    protected $table  = 'order_check';
    
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
     * Lista todos los Items Relacionados por ID
     * 
     * @param type $id
     * @return type
     */
    public function findAllById($id) {
        $resultSet = $this->select(function (Select $select) use($id){
                    $select->where(array('id'=>$id));
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
                    $select->where(array('id'=>$id));
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
    public function insertOrder($params){
        $entity = new Order();
        $entity->setIdsecurity($params['order']['id_security']);
        $entity->setUserid($params['order']['user_id']);
        $entity->setTotal($params['order']['total']);        
        $entity->setOrderdate($params['order']['order_date']);
        $entity->setIp($params['order']['ip']);
        $entity->setOrderstatus($params['order']['order_status']);
        $data = $this->getEntities($entity);
        $this->insert($data);
        return $this->lastInsertValue;
    }
    
    /**
     * Actualiza una Orden
     * 
     * @param type $id
     * @param type $status
     */
    public function updateStatus($id,$status){
        $data = array(
            'order_status'=>$status
        );        
        $this->update($data,array('id'=>$id));
    }
    
    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Order
     */
    public function setEntity($row){
        $entity = new Order();
        $entity->setId($row->id);
        $entity->setIdsecurity($row->id_security);
        $entity->setUserid($row->user_id);
        $entity->setTotal($row->total);
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
    public function getEntities(Order $entity){
        $entities= array(
            'id'=>$entity->getId(),
            'id_security'=>$entity->getIdsecurity(),
            'user_id'=>$entity->getUserid(),
            'total'=>$entity->getTotal(),
            'order_status'=>$entity->getOrderstatus(),
            'order_date'=>$entity->getOrderdate(),
            'ip'=>$entity->getIp()
        ); 
        return $entities;
    }   
}
