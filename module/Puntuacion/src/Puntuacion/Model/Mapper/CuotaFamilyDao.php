<?php

namespace Puntuacion\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Expression as Expression;

class CuotaFamilyDao extends AbstractDbMapper {

    protected $tableName = 'user_cuota_f';

    public function getCuotasByUser($user, $month){
        $select = $this->getSelect();
        $select->join('familias', 'familias.familia_id = user_cuota_f.familia_id', 
                        array('familia_text' => 'nombre') );
        $select->join('puntuacion', 'puntuacion.cuota = user_cuota_f.cuota_id', 
                        array('venta' => 'venta', 'puntos' => 'puntos' ), 'left' );
        $select->where(array(
                    'user_cuota_f.usuario_id' => $user,
                    'user_cuota_f.mes' => $month
                 ));

        $return = $this->select($select)->buffer();
        return $return->toArray();
    }
}