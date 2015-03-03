<?php
namespace Mecanica\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

class ProductsTable extends AbstractTableGateway {
	
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function getProduct($product_id){
    	
    	$productsTable = new TableGateway('products', $this->adapter);
		$rowset = $prodDistTable->select(array(
    			'producto_id' => $product_id,
    			'status' => 1
    		));
		$product = $rowset->current();
		return $product;
    }

}