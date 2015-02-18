<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserInfoCandidatoDao extends AbstractDbMapper {

    protected $tableName = 'user_info_candidato';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setUserInfoCandidatoId($result->getGeneratedValue());
        return $entity;
    }

}
