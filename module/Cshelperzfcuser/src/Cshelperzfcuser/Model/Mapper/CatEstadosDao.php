<?php

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;

class CatEstadosDao extends AbstractDbMapper {

    protected $tableName = 'cat_estados';

    public function getEstados() {
        $select = $this->getSelect();
        return $this->select($select)->buffer();
    }

//000000
}
