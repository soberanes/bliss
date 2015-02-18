<?php

namespace Csproductcmf\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;

class PeriodoscanjeTable extends AbstractTableGateway {

    protected $table = 'periodos_canje';

    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function readPeriodos() {
        $resultSet = $this->select(function (Select $select) {
            $select->where(array('status' => 1));
        });

        $data = $resultSet->buffer();
        $periodos = array();
        if ($data) {
            $i = 0;
            foreach ($data as $d) {
                $periodos[$i]['from'] = $d->date_start;
                $periodos[$i]['to'] = $d->date_end;
                $i++;
            }
        }

        return $periodos;
    }

}
