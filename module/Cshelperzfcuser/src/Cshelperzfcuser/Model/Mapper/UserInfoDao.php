<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserInfoDao extends AbstractDbMapper {

    protected $tableName = 'user_info';

    public function saveUser($entity, $tableName = null, HydratorInterface $hydrator = null) {

        $where = array('user_id' => $entity->getUserId());
        $result = parent::update($entity, $where, $tableName, $hydrator);
        $entity->setUserId($result->getGeneratedValue());

        return $entity;
    }

    //createUser
    public function createUser($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setUserId($result->getGeneratedValue());
        return $entity;
    }

    public function getFechaCreacionByUserId($userId) {
        $select = $this->getSelect()
                ->where(array('user_id' => $userId));
        return $this->select($select)->current();
    }

}
