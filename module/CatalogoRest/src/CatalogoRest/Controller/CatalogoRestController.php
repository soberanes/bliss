<?php
namespace CatalogoRest\Controller;
 
use Zend\Mvc\Controller\AbstractRestfulController;
 
use Application\Model\Product;
use Application\Model\ProductTable;
use Zend\View\Model\JsonModel;

class CatalogoRestController extends AbstractRestfulController
{
	protected $productTable;
	
	public function getProductTable(){
	    if (!$this->productTable) {
	        $sm = $this->getServiceLocator();
	        $this->productTable = $sm->get('Application\Model\ProductTable');
	    }
	    return $this->productTable;
	}

	public function getList(){
        $results = $this->getProductTable()->fetchAll();
	    $data = array();
	    foreach($results as $result) {
	        $data[] = $result;
	    }
	 	
		return new JsonModel(array(
	        'data' => $data,
	    ));
    }
}