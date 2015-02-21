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
        $entity->setArchivoId($result->getGeneratedValue());
        return $entity;
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



}
