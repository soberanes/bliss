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
use Cscore\Model\Entity\Orderitem as Orderitem;
class OrderitemTable extends AbstractTableGateway{
    
    /**
     * nombre de tabla 
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
     * Lista un Item Relacionado a un ID
     * 
     * @param type $id
     * @return type
     */
    public function fetchOneById($id) {
        $resultSet = $this->select(function (Select $select) use($id){
                    $select->where(array('order_id'=>$id));
                    $select->order('order_id ASC');
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
     * Inserta Items
     * 
     * @param type $params
     */
    public function insertItem($params){
        foreach ($params['order_item'] as $item) {            
            $entity = new Orderitem();
            $entity->setOrderid($item['order_id']);
            $entity->setProductid($item['product_id']);
            $entity->setQuantity($item['quantity']);
            $entity->setPrice($item['price']);
            $entity->setFees($item['fees']);
            $entity->setLinetotal($item['line_total']);
            $data = $this->getEntities($entity);
            $this->insert($data);
        }
    }
    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Orderitem
     */
    public function setEntity($row){
        $entity = new Orderitem();
        $entity->setOrderid($row->order_id);
        $entity->setProductid($row->product_id);
        $entity->setQuantity($row->quantity);
        $entity->setPrice($row->price);
        $entity->setFees($row->fees);
        $entity->setLinetotal($row->line_total);
        return $entity;
    }
    /**
     * Obtiene tipos de datos a entidades
     * 
     * @param \Cscore\Model\Entity\Orderitem $entity
     * @return type
     */
    public function getEntities(Orderitem $entity){
        $entities= array(
            'order_id'=>$entity->getOrderid(),
            'product_id'=>$entity->getProductid(),
            'quantity'=>$entity->getQuantity(),
            'price'=>$entity->getPrice(),
            'fees'=>$entity->getFees(),
            'line_total'=>$entity->getLinetotal()
        ); 
        return $entities;
    }
}