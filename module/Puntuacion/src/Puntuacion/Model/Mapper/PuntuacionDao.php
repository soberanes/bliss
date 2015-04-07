<?php

namespace Puntuacion\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class PuntuacionDao extends AbstractDbMapper {

    protected $tableName = 'puntuacion';

    public function getPuntosByUser($user, $month){
        $select = $this->getSelect();
        $select->where(array(
        			'user_id' => $user,
        			'mes' => $month
        		 ));
        return $this->select($select);
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        return $result;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null) {
        
        $where = array(
        	'puntuacion_id' => $entity->getPuntuacionId()
        );
        
        $result = parent::update($entity, $where, $tableName, $hydrator);
        
        return $result->getGeneratedValue();
    }

    public function exists($user = null, $month = null, $cuota = null) {
        $select = $this->getSelect();
        if ($user !== null) {
            $select->where(array('user_id' => $user));
        }
        if ($month !== null) {
            $select->where(array('mes' => $month));
        }
        if ($cuota !== null) {
            $select->where(array('cuota' => $cuota));
        }


        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }


}
