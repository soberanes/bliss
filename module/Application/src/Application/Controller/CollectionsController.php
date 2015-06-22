<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Collection;
use Application\Model\CollectionTable;
use Application\Form\CollectionForm;
use Application\Form\CollectionRelationsForm;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Sql\Select;

class CollectionsController extends AbstractActionController
{
	protected $collectionTable;

	//remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}

	public function getCollectionTable(){
        if(!$this->collectionTable){
            $sm = $this->getServiceLocator();
            $this->collectionTable = $sm->get('Application\Model\CollectionTable');
        }
        return $this->collectionTable;
    }

    public function indexAction(){
    	//validate logged in
        $auth = new AuthenticationService();
		$identity = $auth->getIdentity();
		
		if (!$auth->hasIdentity()) {
			return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));	
		}

        $select = new Select();

        $order_by = $this->params()->fromRoute('order_by') ?
                $this->params()->fromRoute('order_by') : 'id';
        $order = $this->params()->fromRoute('order') ?
                $this->params()->fromRoute('order') : Select::ORDER_ASCENDING;

        $select->order($order_by . ' ' . $order);

        return new ViewModel(array(
            'collections' => $this->getCollectionTable()->fetchAll($select),
            'order_by' => $order_by,
            'order' => $order,
        ));
    }

    public function searchResultAction(){

        $request = $this->getRequest();
        if($request->isPost()){


            $data = $request->getPost()->toArray();

            $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

            $search_result  = $this->getCollectionTable()->searchProduct($data['search-filter'], $data['search-collection'], $dbAdapter);
            $collection     = $this->getCollectionTable()->getCollection($data['search-collection']);

            $view = new ViewModel(array(
                'collection' => $collection,
                'products' => $search_result,
            ));

            $view->setTerminal(true);
            return $view;

        }else{
            $this->getResponse()->setStatusCode(404);
            return;
        }
    }

    public function addProductsAction(){
		
		$this->getResponse()->setStatusCode(404);
		return; 
    	//validate logged in
        // $auth = new AuthenticationService();
        // $identity = $auth->getIdentity();
        
        // if (!$auth->hasIdentity()) {
            // return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));  
        // }

        // $id =  (int) $this->params()->fromRoute('id', 0);
        // if(!$id){
            // return $this->redirect()->toRoute('collections');
        // }

        // $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        // $form = new CollectionRelationsForm();

        // return new ViewModel(array(
            // 'collection' => $this->getCollectionTable()->getCollection($id),
            // 'in_products' => $this->getCollectionTable()->getAddedProducts($id, $dbAdapter),
            // 'products' => $this->getCollectionTable()->getProducts($id, $dbAdapter),
        // ));
    }

    public function addToCollectionAction(){

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $request = $this->getRequest();
        if($request->isPost()){
            $data = $request->getPost();

            $this->getCollectionTable()->addToCollection($data, $dbAdapter);
        }

        return $this->redirect()->toRoute('collections', array(
           'controller' => 'collections',
           'action' =>  'add-products',
           'id' => 1  // in this case "okay"
        )); 
    }

    public function removeFromCollectionAction(){

        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');

        $request = $this->getRequest();
        if($request->isPost()){
            $data =  $request->getPost();

            $this->getCollectionTable()->removeFromCollection($data, $dbAdapter);
        }

        return $this->redirect()->toRoute('collections', array(
           'controller' => 'collections',
           'action' =>  'add-products',
           'id' => 1  // in this case "okay"
        )); 

    }

    public function addAction(){
        //validate logged in
        $auth = new AuthenticationService();
        $identity = $auth->getIdentity();
        
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));  
        }

        //make the action
        $form = new CollectionForm();
        
        $request = $this->getRequest();
        if($request->isPost()){
            $collection = new Collection();
            $form->setInputFilter($collection->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $collection->exchangeArray($form->getData());
                $this->getCollectionTable()->saveCollection($collection);
                
                //Redirect to list of collections
                return $this->redirect()->toRoute('collections');
            }
        }
        return array('form'=>$form);
    }

    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('collections', array(
                'action' => 'add'
            ));
        }
        
        try {
             $collection = $this->getCollectionTable()->getCollection($id);
        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('collections', array(
                'action' => 'index'
            ));
        }
        
        $form = new CollectionForm();
        $form->bind($collection);
        
        $request = $this->getRequest();
        if($request->isPost()){

            $form->setInputFilter($collection->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid()){

                $this->getCollectionTable()->saveCollection($collection);
                
                return $this->redirect()->toRoute('collections');
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
        
    }

    public function deleteAction(){
        //validate logged in
        $auth = new AuthenticationService();
        $identity = $auth->getIdentity();
        
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));  
        }

        //make the action
        $id =  (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('collections');
        }

        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del', 'no');
            
            if($del == 'yes'){
                $id = (int) $request->getPost('id');
                $this->getCollectionTable()->deleteCollection($id);
            }
            
            return $this->redirect()->toRoute('collections');
        }
        
        return array(
            'id' => $id,
            'collection' => $this->getCollectionTable()->getCollection($id),
        );

    }

}