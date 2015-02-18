<?php

namespace Uploader\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ModArchivosDao extends AbstractDbMapper {

    protected $tableName = 'mod_archivos';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setArchivosId($result->getGeneratedValue());
        return $entity;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null) {
        if (!$where) {
            $where = 'filename=\'' . $entity->getFileName() . '\'';
        }
        $result = parent::update($entity, $where, $tableName, $hydrator);
        return $result->getGeneratedValue();
    }

    public function exists($userId = null, $fileId = null, $estatus = 2) {
        $select = $this->getSelect()->where(array('estatus' => $estatus));
        if ($userId !== null) {
            $select->where(array('user_id' => $userId));
        }
        if ($fileId !== null) {
            $select->where(array('archivos_id' => $fileId));
        }
        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

}
