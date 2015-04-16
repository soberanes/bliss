<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;

class CatEstadosDao extends AbstractDbMapper {

    protected $tableName = 'estados';

    public function getEstados() {
        $select = $this->getSelect();
        return $this->select($select)->buffer();
    }

    public function getEstado($estado_id) {
        $select = $this->getSelect()
        			   ->where(array('estado_id' => $estado_id));
        $return = $this->select($select)->current();
        
        return $return;
    }
}
