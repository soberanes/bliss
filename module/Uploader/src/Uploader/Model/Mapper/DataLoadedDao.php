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

    public function exists($userId = null, $archivoId = null) {
        $select = $this->getSelect();
        if ($userId !== null) {
            $select->where(array('user_id' => $userId));
        }
        if ($archivoId !== null) {
            $select->where(array('archivo_id' => $archivoId));
        }
        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function getById($dataId) {
        $select = $this->getSelect()->where(array('data_loaded_id' => $dataId));
        
        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

}
