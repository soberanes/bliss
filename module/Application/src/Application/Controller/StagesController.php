<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Stage;
use Application\Model\StageTable;
use Application\Form\StageForm;
use Application\Form\StageRelationsForm;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Sql\Select;

class StagesController extends AbstractActionController
{
	protected $stagesTable;

	//remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}

	public function getStageTable(){
        if(!$this->stagesTable){
            $sm = $this->getServiceLocator();
            $this->stagesTable = $sm->get('Application\Model\StageTable');
        }
        return $this->stagesTable;
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

        $stages = $this->getStageTable()->fetchAll($select);

        return new ViewModel(array(
            'stages' => $stages,
            'order_by' => $order_by,
            'order' => $order,
        ));
	}
	
	public function configAction(){
		//validate logged in
        $auth = new AuthenticationService();
        $identity = $auth->getIdentity();
        
        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));  
        }
		
		$id =  (int) $this->params()->fromRoute('id', 0);
        if(!$id){
            return $this->redirect()->toRoute('stages');
        }
		
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		//$form = new CollectionRelationsForm();
		
		$checked_collections = array();
		$in_collections = $this->getStageTable()->getCollectionsIn($id, $dbAdapter);
		foreach($in_collections as $in_collection){
			array_push($checked_collections, $in_collection->collection);
		}
					
		return new ViewModel(array(
            'stage' => $this->getStageTable()->getStage($id),
            'in_collections' => $checked_collections,
			'collections' => $this->getStageTable()->getCollections($id, $dbAdapter),
        ));	
	}
	
	public function addToStageAction(){
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $request = $this->getRequest();
        if($request->isPost()){
            $data = $request->getPost();
			$stage = $data->stage_id;
			$collections = $data->collections;
			
            $this->getStageTable()->addToStage($stage, $collections, $dbAdapter);
        }
		
		return $this->redirect()->toRoute('stages');
	}
	
	
}