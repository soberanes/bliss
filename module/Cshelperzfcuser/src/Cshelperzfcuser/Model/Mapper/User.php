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

    public function exists($username) {
        $select = $this->getSelect();
        $select->where(array('username' => $username));

        $resultSet = $this->select($select)->current();
        
        return $resultSet;
    }

    public function getUsersByParent($user_id) {
        $select = $this->getSelect()->where(array('parent' => $user_id));
        $entity = $this->select($select);

        return $entity->buffer()->toArray();
    }
    
    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setUserId($result->getGeneratedValue());
        return $entity;
    }

    public function saveUser($entity, $profileEntity, $tableName = null, HydratorInterface $hydrator = null) {
        
        $entity->setDisplayName($profileEntity->getFullname());
        $entity->setEmail($profileEntity->getEmail());

        $where = array('user_id' => $entity->getUserId());
        $result = parent::update($entity, $where, $tableName, $hydrator);
        // $entity->setUserId($result->getGeneratedValue());
        
        return $entity;
    }

}