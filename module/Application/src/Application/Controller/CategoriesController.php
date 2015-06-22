<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Category;
use Application\Form\CategoryForm;
use Zend\Authentication\AuthenticationService;

use Zend\Db\Sql\Select;

class CategoriesController extends AbstractActionController
{
	protected $categoryTable;

	//remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}

	public function getCategoryTable(){
        if(!$this->categoryTable){
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Application\Model\CategoryTable');
        }
        return $this->categoryTable;
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
            'categories' => $this->getCategoryTable()->fetchAll($select),
            'order_by' => $order_by,
            'order' => $order,
        ));
    }

    public function addAction(){
        //validar logged in
        $auth = new AuthenticationService();
        $identity = $auth->getIdentity();
        
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));  
        }

        //make the action
        $form = new CategoryForm();
        
        $request = $this->getRequest();
        if($request->isPost()){
            $category = new Category();
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $category->exchangeArray($form->getData());
                $this->getCategoryTable()->saveCategory($category);
                
                //Redirect to list of categories
                return $this->redirect()->toRoute('categories');
            }
        }
        return array('form'=>$form);
    }

    public function editAction(){
    	//validar logged in
    	$auth = new AuthenticationService();
		$identity = $auth->getIdentity();
		
		if (!$auth->hasIdentity()) {
			return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));	
		}

		//make the action
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('categories', array(
                'action' => 'add'
            ));
        }
        
        try {
             $category = $this->getCategoryTable()->getCategory($id);
         }
        catch (\Exception $ex) {
             return $this->redirect()->toRoute('categories', array(
                 'action' => 'index'
             ));
         }
        
        $form = new CategoryForm();
        $form->bind($category);
        
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setInputFilter($category->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $this->getCategoryTable()->saveCategory($category);
                
                return $this->redirect()->toRoute('categories');
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction(){
        //validar logged in
        $auth = new AuthenticationService();
        $identity = $auth->getIdentity();
        
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));  
        }

        //make the action
        $id =  (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('categories');
        }

        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del', 'no');
            
            if($del == 'yes'){
                $id = (int) $request->getPost('id');
                $this->getCategoryTable()->deleteCategory($id);
            }
            
            return $this->redirect()->toRoute('categories');
        }
        
        return array(
            'id' => $id,
            'category' => $this->getCategoryTable()->getCategory($id),
        );

    }


}