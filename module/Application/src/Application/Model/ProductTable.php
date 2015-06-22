<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGategay;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;

class ProductTable extends AbstractTableGateway
{
	protected $tableGateway;
    protected $table = 'products';
	
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

        //$resultSet = $this->tableGateway->select();
        //$select = $this->tableGateway->getSql()->select();
        $select->join('categories', 'categories.id = products.category', array('cat_id' => 'id', 'category' => 'name'), 'inner');
        $select->join('collections', 'collections.id = products.collection', array('collection_id' => 'id', 'collection' => 'name'), 'inner');
        //$this->_predump($select->getSqlString());
        $resultSet = $this->tableGateway->selectWith($select);
        $resultSet->buffer();
        return $resultSet;
    }

    public function searchProduct($criteria){


        $sqlSelect = $this->tableGateway->getSql()->select();

        $sqlSelect->join('categories', 'categories.id = products.category', array('cat_id' => 'id', 'category' => 'name'), 'inner');
        $sqlSelect->where("code LIKE '%".$criteria."%'");

        $resultSet = $this->tableGateway->selectWith($sqlSelect);

        //$this->_predump($sqlSelect->getSqlString());
        return $resultSet;

    }
	
	public function getProduct($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("No podemos encontrar el producto con el id $id");
        }
        return $row;
    }
	
	public function saveProduct(Product $product){
		

        $data = array(
            'name' => $product->name,
            'code' => $product->code,
            'price' => $product->price,
            'material' => $product->material,
            'category' => $product->category,
            'collection' => $product->collection,
            'baseimage' => $product->baseimage,
            'thumbnail' => $product->thumbnail
        );

        if(!isset($data['baseimage'])){
            unset($data['baseimage']);
            unset($data['thumbnail']);
        }
		
        $id = (int) $product->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        }else{
            if($this->getProduct($id)){
                $this->tableGateway->update($data, array('id' => $id));
            }else{
                throw new \Exception("El ID del producto no existe");
            }
        }
    }

    public function saveSVG(Product $product){
        
		$data = array(
            'svgcode1' => $this->compress($product->svgcode1),
            'svgcode2' => $this->compress($product->svgcode2),
            'svgcode3' => $this->compress($product->svgcode3),
            'image1' => $product->image1,
            'image2' => $product->image2,
            'image3' => $product->image3
        );

        $id = (int) $product->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        }else{
            if($this->getProduct($id)){
                $this->tableGateway->update($data, array('id' => $id));
            }else{
                throw new \Exception("El ID del producto no existe");
            }
        }
    }

    public function deleteProduct($id){
        $this->tableGateway->delete(array('id' => (int) $id));
    }
	
	//Eliminar espacios en blanco del texto SVG
	function compress($buffer){
		
		$buffer = preg_replace('/\s+/', '', $buffer);
		
		return $buffer;
	}
	
}