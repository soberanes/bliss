<?php

namespace Reportes\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;

class UserTable extends AbstractTableGateway {

    /**
     * Nombre de Tabla
     * @var type 
     */
    protected $table = 'user';

    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Obtiene toda la información registrada de usuarios con join de tablas
     */
    public function getUsuariosJoin() {
        $resultSet = $this->select(function (Select $select) {
            $select->columns(array('username'));
            $select->join('user_info', 'user.id=user_info.user_id', array('fullname', 'email', 'phone', 'cellphone', 'address', 'municipio', 'zip_code', 'estado'));
            $select->join('user_info_ad', 'user.id=user_info_ad.user_id', array('region', 'password' => 'info_id', 'sucursal', 'mayorista_nestle', 'participante_mayorista', 'contacto', 'telefono_contacto' => 'telefono', 'telefono_contacto2' => 'telefono2', 'correo_contacto' => 'correo', 'correo_contacto2' => 'correo2'));
            $select->where('user.gid NOT IN (1,4)');
            $select->order('user.user_id asc');
        });
        $rowData = $resultSet->buffer();
        return $rowData->toArray();
    }

}
