<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Album;
use Application\Form\AlbumForm;
use Zend\Authentication\AuthenticationService;

use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;

class AlbumController extends AbstractActionController
{
    protected $albumTable;
	
	//remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}
	
    public function getAlbumTable(){
        if(!$this->albumTable){
            $sm = $this->getServiceLocator();
            $this->albumTable = $sm->get('Application\Model\AlbumTable');
        }
        return $this->albumTable;
    }
    
    public function indexAction(){
    	
        $select = new Select();

        $order_by = $this->params()->fromRoute('order_by') ?
                $this->params()->fromRoute('order_by') : 'id';

        $order = $this->params()->fromRoute('order') ?
                $this->params()->fromRoute('order') : Select::ORDER_ASCENDING;

        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;

        $albums = $this->getAlbumTable()->fetchAll($select->order($order_by . ' ' . $order));

        //!important
        $itemsPerPage = 10;

        $albums->current();

        $paginator = new Paginator(new paginatorIterator($albums));
        $paginator->setCurrentPageNumber($page)
                ->setItemCountPerPage($itemsPerPage)
                ->setPageRange(7);


        return new ViewModel(array(
            'order_by' => $order_by,
            'order' => $order,
            'page' => $page,
            'paginator' => $paginator,
        ));

    }
    
    public function addAction(){
        $form = new AlbumForm();

        $form->get('submit')->setValue('Add');
        
        $request = $this->getRequest();
        if($request->isPost()){
            $album = new Album();
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $album->exchangeArray($form->getData());
                $this->getAlbumTable()->saveAlbum($album);
                
                //Redirect to list of albums
                return $this->redirect()->toRoute('album');
            }
        }
        return array('form'=>$form);
    }
    
    public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('album', array(
                'action' => 'add'
            ));
        }
        
        try {
             $album = $this->getAlbumTable()->getAlbum($id);
         }
        catch (\Exception $ex) {
             return $this->redirect()->toRoute('album', array(
                 'action' => 'index'
             ));
         }
        
        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');
        
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setInputFilter($album->getInputFilter());
            $form->setData($request->getPost());
            
            if($form->isValid()){
                $this->getAlbumTable()->saveAlbum($album);
                
                return $this->redirect()->toRoute('album');
            }
        }
        
        return array(
            'id' => $id,
            'form' => $form,
        );
        
    }
    
    public function deleteAction(){
        $id =  (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('album');
        }
        
        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del', 'No');
            
            if($del == 'Yes'){
                $id = (int) $request->getPost('id');
                $this->getAlbumTable()->deleteAlbum($id);
            }
            
            return $this->redirect()->toRoute('album');
        }
        
        return array(
            'id' => $id,
            'album' => $this->getAlbumTable()->getAlbum($id),
        );
    }
    
}