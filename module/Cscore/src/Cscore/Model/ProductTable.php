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
use Cscore\Model\Entity\Product as Product;
class ProductTable extends AbstractTableGateway{
    /**
     * Nombre de Tabla
     * @var type 
     */
    protected $table  = 'product';
    
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    /**
     * Busca por ID
     * 
     * @param type $id
     * @return type
     */
    public function findId($id){
        $entities =array();
        $resultSet = $this->select(function (Select $select) use ($id){
                    $select->where(array('id' => $id));
                });
        if(count($resultSet)===1){
            $row = $resultSet->current();
            $entity = $this->setEntity($row);
            $entities = $this->getEntities($entity);            
        }
        return $entities;    
    }
    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Product
     */
    public function setEntity($row){
        $entity = new Product();
        $entity->setId($row->id);
        $entity->setSku($row->sku);
        $entity->setOthersku($row->other_sku);
        $entity->setDescription($row->description);
        $entity->setThumbimage($row->thumb_image);
        $entity->setFullimage($row->full_image);
        $entity->setLastupdate($row->last_update);
        $entity->setProductstatus($row->product_status);        
        return $entity;
    }
    /**
     * Obtiene tipo de datos de entidades
     * 
     * @param \Cscore\Model\Entity\Product $entity
     * @return type
     */
    public function getEntities(Product $entity){
        $entities= array(
            'id'=>$entity->getId(),
            'sku'=>$entity->getSku(),
            'other_sku'=>$entity->getOthersku(),
            'description'=>$entity->getDescription(),
            'thumb_image'=>$entity->getThumbimage(),
            'full_image'=>$entity->getFullimage(),
            'last_update'=>$entity->getLastupdate(),
            'product_status'=>$entity->getProductstatus()
        ); 
        return $entities;
    }
    /**
     * Lista Items Paginados
     * 
     * @param type $cat
     * @return type
     */
    public function fetchAllPages($cat=1){
        $resultSet = $this->select(function (Select $select) use($cat){ 
                    $select->join('product_category',
                            'product_category.product_id = product.id','*'
                            ,'left');
                            $select->where(
                                    array('product_category.category_id' => $cat));
                            $select->order('product.id ASC');
                });
        	
        $resultSet->buffer();
        
        return $resultSet;
    }
}
