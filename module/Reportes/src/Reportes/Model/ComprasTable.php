<?php

namespace Reportes\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Expression as Expresion;

class ComprasTable extends AbstractTableGateway {

    /**
     * Nombre de Tabla
     * @var type 
     */
    protected $table = 'compras';

    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Obtiene info de usuario buscado
     * 
     * @return type
     */
    public function getObjetivos() {
        $resultSet = $this->select(function (Select $select) {
            $select->columns(array('user_id', 'compras', 'compras_meta', 'puntos_ganar', 'puntos_ganados'));
            $select->join('user', 'user.user_id=compras.user_id', array('username', 'display_name'));
//            $select->join('user_info', 'user.id=user_info.user_id', array('nombre'));
            $select->join('credits', 'user.id=credits.user_id', array('puntos' => 'credit'));
            $select->join('order_check', 'user.id=order_check.user_id', array('puntos_canjeados' => new Expresion('SUM(total)')),'left');
            $select->where('user.gid NOT IN (1,4)');
            $select->group('compras.user_id');
            $select->order('compras.user_id asc');
        });
        $row = $resultSet->buffer()->toArray();
        return $row;
    }

}
