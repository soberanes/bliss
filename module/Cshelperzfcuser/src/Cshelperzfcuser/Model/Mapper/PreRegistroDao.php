<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class PreRegistroDao extends AbstractDbMapper {

    protected $tableName = 'pre_registro';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->getUserInfoLaboralId($result->getGeneratedValue());
        return $entity;
    }

    public function findByEmail($email) {
        $select = $this->getSelect()->where(array('email' => $email));
        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

}
