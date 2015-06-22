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

class CollectionTable extends AbstractTableGateway
{
	protected $tableGateway;
	protected $table ='collections';
    protected $table_products = 'products';
    protected $table_relation = 'collections_products';

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

    public function getProducts($collection, $adapter){
        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT products.*, categories.name AS category_name FROM products 
            INNER JOIN categories ON categories.id = products.category 
            WHERE products.id NOT IN ( 
                SELECT collections_products.product FROM collections_products WHERE collections_products.collection = ".$collection.")");
        
        $select->prepareStatement($adapter, $statement);

        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        //$this->_predump($sqlSelect->getSqlString());

        return $resultSet;
    }

    public function searchProduct($criteria, $collection, $adapter){
        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT products.*, categories.id AS cat_id, categories.name AS category FROM products 
            INNER JOIN categories ON categories.id = products.category WHERE products.code LIKE '%".$criteria."%' 
                AND products.id NOT IN(SELECT collections_products.product FROM collections_products WHERE collections_products.collection = ".$collection.");");
        
        $select->prepareStatement($adapter, $statement);
        
        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;
    }

    public function getAddedProducts($collection, $adapter){

        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT collections_products.*, collections.id AS collection_id, collections.name AS collection_name, products.id AS product_id, products.name AS product_name, products.code AS product_code, products.price AS product_price, products.material AS product_material, products.baseimage AS product_baseimage, products.thumbnail AS product_thumbnail, products.svgcode AS product_svgcode, products.category AS product_category, categories.name AS category_name FROM collections_products 
            INNER JOIN collections ON collections.id = collections_products.collection 
            INNER JOIN products ON products.id = collections_products.product 
            INNER JOIN categories ON categories.id = products.category
            WHERE collections.id = ".$collection."");

        $select->prepareStatement($adapter, $statement);

        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;
        
    }

    public function getCollection($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("No podemos encontrar la colección con el id $id");
        }
        return $row;
    }

    public function addToCollection($data_insert, $adapter){

        $data = array(
            'collection' => $data_insert->collection,
            'product'    => $data_insert->product
        );

        $sql = new Sql($adapter);

        $insert = $sql->insert('collections_products');

        $insert->values($data);
        
        $selectString = $sql->getSqlStringForSqlObject($insert);

        $results = $adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

    }

    public function removeFromCollection($data_remove, $adapter){

        $remove_row = $data_remove["remove_row"];

        $sql = new Sql($adapter);

        $delete_query = $sql->delete('collections_products')->where('id = '.$remove_row);

        $deleteString = $sql->getSqlStringForSqlObject($delete_query);

        $results = $adapter->query($deleteString, Adapter::QUERY_MODE_EXECUTE);

    }  

    public function saveCollection(Collection $collection){
    	
        $data = array(
            'name' => $collection->name
        );

        $id = (int) $collection->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        }else{
            if($this->getCollection($id)){
                $this->tableGateway->update($data, array('id' => $id));
            }else{
                throw new \Exception("El ID de la colección no existe");
            }
        }
    }

    public function deleteCollection($id){
        $this->tableGateway->delete(array('id' => (int) $id));
    }

    //Dashboard counts
    public function getFetchProducts($adapter){
        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT * FROM products");

        $select->prepareStatement($adapter, $statement);
        
        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;

    }

    public function getFetchCategories($adapter){
        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT * FROM categories");

        $select->prepareStatement($adapter, $statement);
        
        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;

    }

    public function getFetchCollections($adapter){
        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT * FROM collections");

        $select->prepareStatement($adapter, $statement);
        
        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;

    }

    public function getFetchStages($adapter){
        if (null === $select)
            $select = new Select();

        $statement = $adapter->query("SELECT * FROM stages");

        $select->prepareStatement($adapter, $statement);
        
        $resultSet = new ResultSet();
        $resultSet->initialize($statement->execute());

        return $resultSet;

    }

}