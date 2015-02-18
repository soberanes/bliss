<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserInfoLaboralDao extends AbstractDbMapper {

    protected $tableName = 'user_info_laboral';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->getUserInfoLaboralId($result->getGeneratedValue());
        return $entity;
    }

}
