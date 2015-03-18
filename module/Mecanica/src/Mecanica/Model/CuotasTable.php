<?php
namespace Mecanica\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Sql;

class CuotasTable extends AbstractTableGateway {
	
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function fetchAll(){
    	
    	$sql = new Sql($this->adapter);
    	$select = $sql->select();
    	$select->from('user_cuota');

    	$statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $response = array();
        foreach ($resultSet as $key => $value) {
        	$response[$key] = $value;
        }
        return $response;
    }

    public function getCuota($user, $month, $family){
        $sql = new Sql($this->adapter);
    	$select = $sql->select();
    	$select->from('user_cuota_f')
    		   ->where(array(
                        'usuario_id' => $user,
                        'mes'        => $month,
                        "familia_id" => $family
                      ));

    	$statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet->current();
    }

    private function toArray($arg){
    	$response = array();
    	foreach ($arg as $key => $value) {
    		$response[$key] = $value;
    	}
    	return $response;
    }

}