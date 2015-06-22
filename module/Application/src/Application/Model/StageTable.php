<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGategay;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Adapter\Driver\DriverInterface;

class StageTable extends AbstractTableGateway
{
	protected $tableGateway;
	protected $table ='stages';

	public function __construct($tableGateway){
        $this->tableGateway = $tableGateway;
    }

    //remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}

	//Query to database
	public function fetchAll(Select $select = null){
        if (null === $select)
            $select = new Select();
        $select->from($this->table);

        //$this->_predump($select->getSqlString());
        $resultSet = $this->tableGateway->selectWith($select);
        $resultSet->buffer();
        return $resultSet;
    }
	
	public function getCollectionsCount($stage){
		$select = new Select();
		$select->from('stages_collections')->where(array('stage' => $stage));
		$row = $rowset->current();
        if(!$row){
            throw new \Exception("No podemos encontrar el escenario con el id $id");
        }
		
		echo "<pre>";var_dump($row);die;
	}
	
	function getStage($id){
		$id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("No podemos encontrar el escenario con el id $id");
        }
        return $row;
	}
	
	public function getCollections($stage, $adapter){
		if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT * FROM collections");

        $select->prepareStatement($adapter, $statement);

        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;
	}
	
	public function getCollectionsIn($stage, $adapter){
		if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT collection FROM stages_collections INNER JOIN collections ON stages_collections.collection = collections.id 
WHERE stages_collections.stage = ".$stage." ORDER BY collections.name ASC");

        $select->prepareStatement($adapter, $statement);

        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;
	}
	
	public function addToStage($stage, $collections, $adapter){
		//delete from table
		$sql = new Sql($adapter);
        $delete_query = $sql->delete('stages_collections')->where('stage = '.$stage);
        $deleteString = $sql->getSqlStringForSqlObject($delete_query);
        $results = $adapter->query($deleteString, Adapter::QUERY_MODE_EXECUTE);
		
		//insert into table
		if(isset($collections)){
			foreach($collections as $collection){
				$data = array(
					'stage' 	 => $stage,
					'collection' => $collection
				);
				$insert = $sql->insert('stages_collections');
				$insert->values($data);
				$selectString = $sql->getSqlStringForSqlObject($insert);
				$results = $adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
			}
		}
	}
	
}