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
use Zend\Db\Sql\Delete as Delete;
use Cscore\Model\Entity\Cart as Cart;

class CartTable extends AbstractTableGateway {

    /**
     * nombre de tabla 
     * @var type 
     */
    protected $table = 'cart';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * List Items Cart Shop
     * 
     * @param type $userid
     * @return type
     */
    public function fetchAllCarByUserId($userid) {
        $resultSet = $this->select(function (Select $select) use($userid) {
            $select->join('product', 'product.id = cart.product_id', '*');
            $select->join('product_category', 'product.id = product_category.product_id', '*');
            $select->join('category', 'category.id = product_category.category_id', array('categoria' => 'name'));
            $select->where(
                    array('cart.user_id' => $userid));
            $select->order('product.id ASC');
        });

        // echo $sql->getSqlstringForSqlObject($select);die;

        $resultSet->buffer();
        $entity = $this->getEntitiesJoin($resultSet);
        return $entity;
    }

    /**
     * Busca por Id
     * 
     * @param type $id
     * @return type
     */
    public function findId($id) {
        $entities = array();
        $resultSet = $this->select(function (Select $select) use ($id) {
            $select->where(array('id' => $id));
        });
        if (count($resultSet) === 1) {
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
     * @return \Cscore\Model\Entity\Cart
     */
    public function setEntity($row) {
        $entity = new Cart();
        $entity->setUserid($row->user_id);
        $entity->setProductid($row->product_id);
        $entity->setQuantity($row->quantity);
        $entity->setPrice($row->price);
        $entity->setFees($row->fees);
        $entity->setLinetotal($row->line_total);
        return $entity;
    }

    /**
     * Obtiene Tipo de Dato de entidades
     * 
     * @param \Cscore\Model\Entity\Cart $entity
     * @return type
     */
    public function getEntities(Cart $entity) {
        $entities = array(
            'user_id' => $entity->getUserid(),
            'product_id' => $entity->getProductid(),
            'quantity' => $entity->getQuantity(),
            'price' => $entity->getPrice(),
            'fees' => $entity->getFees(),
            'line_total' => $entity->getLinetotal()
        );
        return $entities;
    }

    /**
     * Obtiene Tipo de Dato de entidades desde Join
     * 
     * @param type $resultSet
     * @return type
     */
    public function getEntitiesJoin($resultSet) {
        $entities = array();
        if (count($resultSet) > 0) {
            foreach ($resultSet as $row) {
                $map = array(
                    'user_id' => $row->user_id,
                    'product_id' => $row->product_id,
                    'quantity' => $row->quantity,
                    'price' => $row->price,
                    'fees' => $row->fees,
                    'line_total' => $row->line_total,
                    'id' => $row->id,
                    'sku' => $row->sku,
                    'other_sku' => $row->other_sku,
                    'description' => $row->description,
                    'thumb_image' => $this->_getNameImages($row->thumb_image),
                    'full_image' => $row->full_image,
                    'last_update' => $row->last_update,
                    'product_status' => $row->product_status,
                    'category' => $row->categoria
                );
                $entities[] = $map;
            }
        }
        return $entities;
    }

    /**
     * Forma Nombre de imagenes de items
     * 
     * @param type $inputName
     * @return type
     */
    private function _getNameImages($inputName) {

        if (!empty($inputName)) {
            $tmp = explode('200x200', $inputName);
            $output = $tmp[0];
            $output.=key_exists(1, $tmp) ? $tmp[1] : '';
        } else {
            $output = $inputName;
        }
        return $output;
    }

    /**
     * Elimina un producto del carrito
     * 
     * @param type $userid
     * @param type $productid
     * @return type
     */
    public function deteleProdut($userid, $productid) {
        $param = array(
            'user_id' => $userid,
            'product_id' => $productid
        );

        $result = $this->delete(function (Delete $delete) use($param) {
            $delete->where(
                    array(
                        'user_id' => $param['user_id'],
                        'product_id' => $param['product_id']
                    )
            );
        });
        return $result;
    }

    /**
     * Agrega un producto al carrito
     * 
     * @param type $param
     */
    public function add($param) {
        $resultSet = $this->select(function (Select $select) use($param) {
            $select->where(
                    array(
                        'user_id' => $param['user_id'],
                        'product_id' => $param['product_id']
            ));
        });
        $data = array(
            'user_id' => (int) $param['user_id'],
            'product_id' => (int) $param['product_id'],
            'quantity' => (int) $param['quantity'],
            'price' => (double) $param['price'],
            'line_total' => (float) $param['line_total']
        );
        if (count($resultSet) === 0) {
            $this->insert($data);
        } else {
            $entities = array();
            foreach ($resultSet as $row) {
                $entity = $this->setEntity($row);
                $entities = $this->getEntities($entity);
            }
            $entities['quantity'] += $data['quantity'];
            $entities['price'] += $data['price'];
            $entities['fees'] += $entities['fees'];
            $entities['line_total'] += $data['line_total'];


            $this->update($entities, array(
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id']));
        }
    }

    /**
     * Vacea Carrito por ID de Usuario
     * 
     * @param type $userid
     * @return type
     */
    public function emptyCartByUserid($userid) {
        $result = $this->delete(function (Delete $delete) use($userid) {
            $delete->where(array('user_id' => $userid,));
        });
        return $result;
    }

}
