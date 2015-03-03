<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Mecanicas\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;

class ProductosHomologadosTable extends AbstractTableGateway {

    /**
     * nombre de tabla 
     * @var type 
     */
    protected $table = 'productos_homologados';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function getPuntos($sku, $mayoristaId, $perfilId) {
        $resultSet = $this->select(function (Select $select) use($sku, $mayoristaId, $perfilId) {
            $select->join(array('b' => 'productos_puntuacion'), 'productos_homologados.producto_global_id=b.producto_global_id', '*');
            $select->where(array('productos_homologados.sku_mayorista' => $sku));
            $select->where(array('productos_homologados.mayorista_id' => $mayoristaId));
            $select->where(array('b.perfil_id' => $perfilId));
//            echo $select->getSqlString();
        });
        return $resultSet->current();
    }

    public function getProductos($mayoristaId, $perfilId) {
        $resultSet = $this->select(function (Select $select) use($mayoristaId, $perfilId) {
            $select->join(array('b' => 'productos_puntuacion'), 'productos_homologados.producto_global_id=b.producto_global_id', '*');
            $select->join(array('c' => 'productos_globales'), 'productos_homologados.producto_global_id=c.productos_globales_id', '*');
            $select->where(array('productos_homologados.mayorista_id' => $mayoristaId));
            $select->where(array('b.perfil_id' => $perfilId));
//            $select->where(array('b.producto_global_id' =>'c.productos_globales_id'));
//            echo $select->getSqlString();
        });
        return $resultSet->buffer();
    }

}
