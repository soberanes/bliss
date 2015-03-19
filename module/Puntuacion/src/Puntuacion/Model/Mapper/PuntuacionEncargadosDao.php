<?php

namespace Puntuacion\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class PuntuacionEncargadosDao extends AbstractDbMapper {

    protected $tableName = 'puntuacion_encargados';

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
        if (!$where) {
            $where = array(
            	'user_id' => $entity->getUserId(),
            	'mes' 	  => $entity->getMes(),
            );
        }
        $result = parent::update($entity, $where, $tableName, $hydrator);
        return $result->getGeneratedValue();
    }

    public function exists($user = null, $month = null) {
        
        $select = $this->getSelect();
        $select->where(array(
                    'user_id' => $user,
                    'mes'     => $month
                ));
        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        
        return $entity;
    }


}
