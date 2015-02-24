<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class User extends AbstractDbMapper {

    protected $tableName = 'user';

    public function getUser($user_id) {
        $select = $this->getSelect();
        $select->where->like('user_id', $user_id);

        $resultSet = $this->select($select)->current();
        
        return $resultSet;   
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setUserId($result->getGeneratedValue());
        return $entity;
    }

}