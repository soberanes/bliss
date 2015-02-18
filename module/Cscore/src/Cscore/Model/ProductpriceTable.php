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
use Cscore\Model\Entity\Productprice as Productprice;
class ProductpriceTable extends AbstractTableGateway{
    /**
     * NOmbre de Tabla
     * @var type 
     */
    protected $table  = 'product_price';
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    /**
     * Listar todos los Items
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
            $map = $this->getEntities($entity);
            $entities[] = $map;
        }
        return $entities;
    }
    
    /**
     * Buscar por ID
     * 
     * @param type $id
     * @return type
     */
    public function findId($id){
        $resultSet = $this->select(function (Select $select) use ($id){
                    $select->where(array('id' => $id));
                }); 
        $row = $resultSet->current();
        $entity = $this->setEntity($row);
        $entities = $this->getEntities($entity);
        return $entities;    
    }
    /**
     * Buscar por ID de producto
     * 
     * @param type $id
     * @return type
     */
    public function findByProductId($id){
        $resultSet = $this->select(function (Select $select) use ($id){
                    $select->where(array('product_id' => $id));
                }); 
        $row = $resultSet->current();
        $entity = $this->setEntity($row);
        $entities = $this->getEntities($entity);
        return $entities;    
    }    
    
    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Productprice
     */
    public function setEntity($row){
        $entity = new Productprice();
        $entity->setId($row->id);
        $entity->setProductid($row->product_id);
        $entity->setPrice($row->price);
        $entity->setCurrency($row->currency);
        $entity->setLastupdate($row->last_update);    
        return $entity;
    }
    
    /**
     * Obtiene Tipo de dato
     * 
     * @param \Cscore\Model\Entity\Productprice $entity
     * @return type
     */
    public function getEntities(Productprice $entity){
        $entities= array(
            'id'=>$entity->getId(),
            'product_id'=>$entity->getProductid(),
            'price'=>$entity->getPrice(),
            'currency'=>$entity->getCurrency(),
            'last_update'=>$entity->getLastupdate()
        ); 
        return $entities;
    }
}