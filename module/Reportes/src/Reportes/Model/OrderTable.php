<?php

namespace Reportes\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;

class OrderTable extends AbstractTableGateway {

    /**
     * Nombre de Tabla
     * @var type 
     */
    protected $table = 'order_item';

    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Obtiene shippinglist para reporteador
     * 
     * @param 
     * @return array
     * 
     */
    public function getOrderlist() {
        $resultSet = $this->select(function (Select $select) {
            $select->columns(array('order_id', 'product_id', 'quantity', 'price'));
            $select->join('order_check', 'order_item.order_id = order_check.id', array('user_id', 'total', 'order_date'));
            $select->join('user', 'order_check.user_id = user.user_id', array('display_name', 'username'));
            $select->join('user_info', 'order_check.user_id = user_info.user_id', array('fullname','email', 'phone','cellphone','zip_code','address','municipio','estado'));
            $select->join('product', 'product.id = order_item.product_id', array('sku', 'description',  'other_sku'));
            $select->where('user.gid NOT IN (1,4)');
            $select->order('order_check.id');
        });

        $data = $resultSet->buffer()->toArray();
        return $data;
    }

}
