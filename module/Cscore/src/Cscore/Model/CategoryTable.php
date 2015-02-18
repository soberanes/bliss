<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */
namespace Cscore\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Cscore\Model\Entity\Category as Category;

class CategoryTable extends AbstractTableGateway{
    /**
     * nombre de tabla 
     * @var type 
     */    
    protected $table  = 'category';
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    /**
     * Listar Todos Los Items
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->where(array('category_status' => 1));
                    $select->order('category_order ASC');
                });

        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = new Category();            
            $entity->setId($row->id);
            $entity->setIdparent($row->id_parent);
            $entity->setName($row->name);
            $entity->setDescription($row->description);
            $entity->setThumbimg($row->thumb_img);
            $entity->setFullimg($row->full_img);
            $entity->setLastupdate($row->last_update);
            $entity->setCategoryorder($row->category_order);
            $entity->setCategorystatus($row->category_status);
   
            $map= array(
                'id'=>$entity->getId(),
                'id_parent'=>$entity->getIdparent(),
                'name'=>$entity->getName(),
                'description'=>$entity->getDescription(),
                'thumb_img'=>$entity->getThumbimg(),
                'full_img'=>$entity->getFullimg(),
                'last_update'=>$entity->getLastupdate(),
                'category_order'=>$entity->getCategoryorder(),
                'category_status'=>$entity->getCategorystatus()
            ); 
            $entities[] = $map;
        }
        return $entities;
    }
    
    /**
     * Buscar Por ID
     * 
     * @param type $id
     * @return type
     */
    public function findId($id){
        $resultSet = $this->select(function (Select $select) use ($id){
                    $select->where(array('id' => $id));
                });
            $entity = new Category();   
            $row = $resultSet->current();
            $entity->setId($row->id);
            $entity->setIdparent($row->id_parent);
            $entity->setName($row->name);
            $entity->setDescription($row->description);
            $entity->setThumbimg($row->thumb_img);
            $entity->setFullimg($row->full_img);
            $entity->setLastupdate($row->last_update);
            $entity->setCategoryorder($row->category_order);
            $entity->setCategorystatus($row->category_status);
   
            $entities= array(
                'id'=>$entity->getId(),
                'id_parent'=>$entity->getIdparent(),
                'name'=>$entity->getName(),
                'description'=>$entity->getDescription(),
                'thumb_img'=>$entity->getThumbimg(),
                'full_img'=>$entity->getFullimg(),
                'last_update'=>$entity->getLastupdate(),
                'category_order'=>$entity->getCategoryorder(),
                'category_status'=>$entity->getCategorystatus()
            ); 

        return $entities;    
    }        
}