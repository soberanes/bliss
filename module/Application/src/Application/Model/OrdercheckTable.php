<?php
/**
 * CookieShop - Class for Mapper SQL.
 * @category   Model
 * @package    Application\Model
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Application\Model\Entity\Ordercheck as Ordercheck;

class OrdercheckTable extends AbstractTableGateway{
    
    /**
     * name table 
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
     * List All Items
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select();
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }

    /**
     * List all Items by ID
     * Ex.	
     * $param = array(
     *       	     'where'=>array('id'=>$id),
     *               'order'=>'id ASC'
     *          );
     * @param type $id
     * @return type
     */
    public function findAllById($param) {
        $resultSet = $this->select(function (Select $select) use($param){
                    $select->where($param['where']);
                    $select->order($param['order']);
                });
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }  

    /**
     * List One a Item by ID
     * Ex.	
     * $param = array(
     *       	     'where'=>array('id'=>$id),
     *               'order'=>'id ASC'
     *          );
     * @param type $id
     * @return type
     */
    public function fetchOneById($param) {
        $resultSet = $this->select(function (Select $select) use($param){
                    $select->where($param['where']);
                    $select->order($param['order']);
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
     * Setter Entities
     * 
     * @param type $row
     * @return \Application\Model\Entity\Ordercheck
     */
    public function setEntity($row){
	$entity = new Ordercheck();
        $entity->setId($row->id);
        $entity->setIdsecurity($row->id_security);
        $entity->setUserid($row->user_id);
        $entity->setTotal($row->total);
        $entity->setOrderdate($row->order_date);
        $entity->setIp($row->ip);
        $entity->setOrderstatus($row->order_status);
        return $entity;
    }

    /**
     * Getter type entity
     * 
     * @param \Application\Model\Entity\Ordercheck $entity
     * @return type
     */
    public function getEntities(Ordercheck $entity){
        $entities= array(
            'id' => $entity->getId(),
            'id_security' => $entity->getIdsecurity(),
            'user_id' => $entity->getUserid(),
            'total' => $entity->getTotal(),
            'order_date' => $entity->getOrderdate(),
            'ip' => $entity->getIp(),
            'order_status' => $entity->getOrderstatus(),
        ); 
        return $entities;
    }

    /**
     * List Items Paginator
     * 
     * @return type
     */
    public function fetchAllPages(){
        $resultSet = $this->select();
        $resultSet->buffer();
        $resultSet->next();        
        return $resultSet;
    }

    /**
     * List all Items by ID
     * Ex.	
     * $param = array(
     *       	     'where'=>array('id'=>$id),
     *               'order'=>'id ASC'
     *          );
     * @param type $id
     * @return type
     */
    public function findAllByIdPages($param) {
        $resultSet = $this->select(function (Select $select) use($param){
                    $select->where($param['where']);
                    $select->order($param['order']);
                });
        $resultSet->buffer();
        $resultSet->next();
        return $resultSet;
    } 
}
