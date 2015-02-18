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
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;
use Mecanicas\Model\Entity\Puntos;

class PuntosTable extends AbstractTableGateway {

    /**
     * nombre de tabla 
     * @var type 
     */
    protected $table = 'puntos';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function write(Puntos $entity) {
        $data = $this->_getData($entity);
        $resultSet = $this->select(function (Select $select) use($data) {
                    $select->where(array('user_id' => $data['user_id'],
                        'facturacion_id' => $data['facturacion_id']));
                })->current();
        if (!$resultSet) {
            $this->insert($data);
        } else {
            $this->changeEstatus(array($data['facturacion_id']));
        }
    }

    public function changeEstatus($facturacionIds) {
//        date_default_timezone_set('America/Mexico_City');
        $where = new Where();
        $where->in('facturacion_id', $facturacionIds);
        $where->equalTo('estatus', 1);
        $data = array('estatus' => 2, 'fecha_actualizacion' => time());
        return $this->update($data, $where);
    }

    public function getPuntosPendientes($facturacionIds) {
        $resultSet = $this->select(function (Select $select) use($facturacionIds) {
//                    $select->columns(array(new Expression('SUM(puntos.puntos) as pts')));
                    $select->where->in('facturacion_id', $facturacionIds);
                    $select->where(array('estatus' => 1));
                })->buffer();
        return $resultSet;
    }

    private function _getData(Puntos $puntos) {
//        date_default_timezone_set('America/Mexico_City');
        return array(
            'user_id' => $puntos->getUserid(),
            'facturacion_id' => $puntos->getFacturacionid(),
            'productos_homologados_id' => $puntos->getProductosHomologadosId(),
            'puntos' => $puntos->getPuntos(),
            'fecha_creacion' => time(),
            'fecha_actualizacion' => $puntos->getFechaactualizacion(),
            'estatus' => $puntos->getEstatus(),
        );
    }

    public function getPtsByIdFact($facturacionIds) {
        $resultSet = $this->select(function (Select $select) use($facturacionIds) {
                    $select->where(array('facturacion_id' => $facturacionIds));
                })->current();
        return $this->_getDataToArray($this->_parseData($resultSet));
    }

    private function _getRead($resultSet) {
        $entries = array();
        foreach ($resultSet as $row) {
            $entries[] = $this->_parseData($row);
        }
        return $entries;
    }

    private function _parseData($row) {
        $entry = new Puntos();
        $entry->setPuntosid($row->puntos_id)
                ->setUserid($row->user_id)
                ->setFacturacionid($row->facturacion_id)
                ->setProductosHomologadosId($row->productos_homologados_id)
                ->setPuntos($row->puntos)
                ->setFechacreacion($row->fecha_creacion)
                ->setFechaactualizacion($row->fecha_actualizacion)
                ->setEstatus($row->estatus);
        return $entry;
    }

    private function _getDataToShow($entries) {
        $entrie = array();
        foreach ($entries as $item) {
            array_push($entrie, $this->_getDataToArray($item));
        }
        return $entrie;
    }

    private function _getDataToArray(Puntos $item) {
        $return = array();
        if ($item !== null) {
            $return = array(
                'puntosid' => $item->puntosid,
                'userid' => $item->userid,
                'facturacionid' => $item->facturacionid,
                'productoshomologadosid' => $item->productoshomologadosid,
                'puntos' => $item->puntos,
                'fechacreacion' => $item->fechacreacion,
                'fechaactualizacion' => $item->fechaactualizacion,
                'estatus' => $item->estatus,
            );
        }
        return $return;
    }

}
