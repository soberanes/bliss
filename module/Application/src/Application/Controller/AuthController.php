<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;

use Application\Form\LoginForm;
use Application\Model\UserTable;
use Application\Model\User;

class AuthController extends AbstractActionController
{
	protected $usersTable = null;
	
	public function getUsersTable(){
		// I have a Table data Gateway ready to go right out of the box
		if (!$this->usersTable) {
			$this->usersTable = new TableGateway(
			'users',
			$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter')
			// new \Zend\Db\TableGateway\Feature\RowGatewayFeature('usr_id') // Zend\Db\RowGateway\RowGateway Object
			// ResultSetPrototype
			);
		}
		return $this->usersTable;
	}
	
	public function indexAction(){
        return new ViewModel();
    }
	
	public function loginAction(){
		
		$user = $this->identity();
		
		$form = new LoginForm();
        $form->get('submit')->setValue('Iniciar sesión');
		$messages = null;
		
		$request = $this->getRequest();
		if($request->isPost()){
			
			$authFormFilters = new User();
			
			$form->setInputFilter($authFormFilters->getInputFilter());	
			
			$form->setData($request->getPost());
			
			if ($form->isValid()) {
				$data = $form->getData();
				
				$sm = $this->getServiceLocator();
				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				
				$config = $this->getServiceLocator()->get('Config');
				$staticSalt = $config['static_salt'];

				$authAdapter = new AuthAdapter($dbAdapter,
					'users', // there is a method setTableName to do the same
					'username', // there is a method setIdentityColumn to do the same
					'password', // there is a method setCredentialColumn to do the same
					"MD5(CONCAT('$staticSalt', ?, password_salt))" // setCredentialTreatment(parametrized string) 'MD5(?)'
				);

				$authAdapter
					->setIdentity($data['username'])
					->setCredential($data['password']);

				$auth = new AuthenticationService();
				
				$result = $auth->authenticate($authAdapter);
				$errorcode = $result->getCode();
				
				switch ($errorcode) {
					case Result::FAILURE_IDENTITY_NOT_FOUND:
						// do stuff for nonexistent identity
						break;
						
					case Result::FAILURE_CREDENTIAL_INVALID:
						// do stuff for invalid credential
						break;
						
					case Result::SUCCESS:
						$storage = $auth->getStorage();
						$storage->write($authAdapter->getResultRowObject(
							null,
							'password'
						));
						$time = 1209600; // 14 days 1209600/3600 = 336 hours => 336/24 = 14 days
						return $this->redirect()->toRoute('home');
						break;

					default:
						// do stuff for other failure
						break;
				}
				
				foreach ($result->getMessages() as $message) {
					$messages .= "$message\n";
				}	
				
			}
			
		}
		
		return new ViewModel(array('form' => $form, 'messages' => $messages, 'errorcode' => $errorcode));
	}

	public function logoutAction(){
		$auth = new AuthenticationService();
		
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}
		
		$auth->clearIdentity();
		
		$sessionManager = new \Zend\Session\SessionManager();
		$sessionManager->forgetMe();
		
		return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));
		
	}
	
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}
	
}
	