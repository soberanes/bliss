<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Sql\Select;
use Application\Model\Collection;
use Application\Model\CollectionTable;

class IndexController extends AbstractActionController
{
	protected $collectionTable;

	public function getCollectionTable(){
        if(!$this->collectionTable){
            $sm = $this->getServiceLocator();
            $this->collectionTable = $sm->get('Application\Model\CollectionTable');
        }
        return $this->collectionTable;
    }

    public function indexAction(){

    	$auth = new AuthenticationService();
		$identity = $auth->getIdentity();
		
		if (!$auth->hasIdentity()) {
			return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));	
		}

		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		
		$count_products 	= $this->getCollectionTable()->getFetchProducts($dbAdapter)->count();
		$count_categories 	= $this->getCollectionTable()->getFetchCategories($dbAdapter)->count();
		$count_collections 	= $this->getCollectionTable()->getFetchCollections($dbAdapter)->count();
		$count_stages 		= $this->getCollectionTable()->getFetchStages($dbAdapter)->count();

        return new ViewModel(array(
        	'count_products' => $count_products,
        	'count_categories' => $count_categories,
        	'count_collections' => $count_collections,
        	'count_stages' => $count_stages,
        ));
    }
	
	public function helloAction(){
		return new ViewModel();
	}
	
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}
}
