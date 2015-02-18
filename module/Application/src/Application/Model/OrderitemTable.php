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
use Application\Model\Entity\Orderitem as Orderitem;

class OrderitemTable extends AbstractTableGateway{
    
    /**
     * name table 
     * @var type 
     */     
    protected $table  = 'order_item';
    
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
     * @return \Application\Model\Entity\Orderitem
     */
    public function setEntity($row){
	$entity = new Orderitem();
        $entity->setId($row->id);
        $entity->setOrderid($row->order_id);
        $entity->setProductid($row->product_id);
        $entity->setQuantity($row->quantity);
        $entity->setPrice($row->price);
        $entity->setFees($row->fees);
        $entity->setLinetotal($row->line_total);
        return $entity;
    }

    /**
     * Getter type entity
     * 
     * @param \Application\Model\Entity\Orderitem $entity
     * @return type
     */
    public function getEntities(Orderitem $entity){
        $entities= array(
            'id' => $entity->getId(),
            'order_id' => $entity->getOrderid(),
            'product_id' => $entity->getProductid(),
            'quantity' => $entity->getQuantity(),
            'price' => $entity->getPrice(),
            'fees' => $entity->getFees(),
            'line_total' => $entity->getLinetotal(),
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
