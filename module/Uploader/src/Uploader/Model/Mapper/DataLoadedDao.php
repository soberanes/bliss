<?php

namespace Uploader\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class DataLoadedDao extends AbstractDbMapper {

    protected $tableName = 'data_loaded';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setDataLoadedId($result->getGeneratedValue());
        return $entity;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null) {
        if (!$where) {
            $where = array(
                'user_id' => $entity->getUserId(),
                'month'   => $entity->getMonth(),
            );
        }
        $result = parent::update($entity, $where, $tableName, $hydrator);
        return $result;
    }

}
