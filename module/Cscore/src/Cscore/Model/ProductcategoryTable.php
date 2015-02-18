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
use Cscore\Model\Entity\Productcategory as Productcategory;

class ProductcategoryTable extends AbstractTableGateway {

    /**
     * NOmbre de Tabla
     * @var type 
     */
    protected $table = 'product_category';

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
     * Buscar por ID de producto
     * 
     * @param type $id
     * @return type
     */
    public function findId($id) {
        $resultSet = $this->select(function (Select $select) use ($id) {
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
     * @return \Cscore\Model\Entity\Productcategory
     */
    public function setEntity($row) {
        $entity = new Productcategory();
        $entity->setId($row->id);
        $entity->setProductid($row->product_id);
        $entity->setCategoryid($row->category_id);

        return $entity;
    }

    /**
     * Obtiene el id de la categoria del producto
     * 
     * @param \Cscore\Model\Entity\Productcategory $entity
     * @return type
     */
    public function getEntities(Productcategory $entity) {
        $entities = array(
            'id' => $entity->getId(),
            'product_id' => $entity->getProductid(),
            'category_id' => $entity->getCategoryid()
        );
        return $entities;
    }

}
