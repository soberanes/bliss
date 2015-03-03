<?php

namespace Uploader\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ModArchivosDao extends AbstractDbMapper {

    protected $tableName = 'mod_archivos';

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setArchivoId($result->getGeneratedValue());
        return $entity;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null) {
        if (!$where) {
            $select->where(array(
                'user_id' => $where['user_id'],
                'period_m' => $where['period']
            ));
        }

        $result = parent::update($entity, $where, $tableName, $hydrator);
        return $entity;
    }

    public function exists($userId = null, $period = null, $fileId = null, $estatus = 1) {
        $select = $this->getSelect()->where(array('status' => $estatus));
        if ($userId !== null) {
            $select->where(array('user_id' => $userId));
        }
        if ($period !== null) {
            $select->where(array('period_m' => $period));
        }
        if ($fileId !== null) {
            $select->where(array('archivos_id' => $fileId));
        }
        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function getFile($archivo_id){
        $select = $this->getSelect()->where(array('archivo_id' => $archivo_id));

        $entity = $this->select($select)->current();
        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function fetchAll($limit = null){
        $select = $this->getSelect();
        $entity = $this->select($select);
        
        return $entity;
    }


}
