<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGategay;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

class CategoryTable extends AbstractTableGateway
{
	protected $tableGateway;
	protected $table ='categories';

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

    public function getCategory($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("No podemos encontrar la categoría con el id $id");
        }
        return $row;
    }

    public function saveCategory(Category $category){
		
        $data = array(
            'name' => $category->name
        );
		
        $id = (int) $category->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        }else{
            if($this->getCategory($id)){
                $this->tableGateway->update($data, array('id' => $id));
            }else{
                throw new \Exception("El ID de la categoría no existe");
            }
        }
    }

    public function deleteCategory($id){
        $this->tableGateway->delete(array('id' => (int) $id));
    }



}










