<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserInfoAdicionalDao extends AbstractDbMapper {

    protected $tableName = 'user_info_adicional';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setUserInfoAdicionalId($result->getGeneratedValue());
        return $entity;
    }

}
