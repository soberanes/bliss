<?php 
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\AuthenticationService;

use Application\Model\UserTable;
use Application\Model\User;

use Application\Form\ForgottenPasswordForm;
use Application\Form\ForgottenPasswordFilter;
use Application\Form\RestorePasswordForm;
use Application\Form\RestorePasswordFilter;

use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class UserController extends AbstractActionController
{
	protected $usersTable = null;

	//remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}

	public function getUsersTable(){
        if(!$this->usersTable){
            $sm = $this->getServiceLocator();
            $this->usersTable = $sm->get('Application\Model\UserTable');
        }
        return $this->usersTable;
    }

	public function indexAction(){

		$auth = new AuthenticationService();
		$identity = $auth->getIdentity();

		if (!$auth->hasIdentity()) {
			return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));	
		}
		
        return new ViewModel(array(
        	'user_logged' => $identity,
            'users' => $this->getUsersTable()->fetchAll()
        ));

    }

    /*
    	- restore password -
		from logged in user link (user)
    */
	public function restorePasswordAction(){

		//validate user logged in
		$auth = new AuthenticationService();
		$identity = $auth->getIdentity();
		$usr_id = $identity->id;

		if (!$auth->hasIdentity()) {
			return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));	
		}

		$form = new RestorePasswordForm();
		$request = $this->getRequest();

		//check data
		if ($request->isPost()) {

			$form->setInputFilter(new RestorePasswordFilter($this->getServiceLocator()));
			$form->setData($request->getPost());
			
			if ($form->isValid()) {

				$data 			= $form->getData();
				$password 		= $data['password'];
				$usersTable 	= $this->getUsersTable();
				$user 			= $usersTable->getUser($usr_id);
				$user->password = $this->encriptPassword($this->getStaticSalt(), $password, $user->password_salt);

				$usersTable->saveUser($user);
 
				//return $this->redirect()->toRoute('user', array('controller'=>'user', 'action'=>'restore-password-success'));
				$view_message = "La contraseña ha sido cambiada con éxito.";

				return new ViewModel(array('form' => $form, 'message' => $view_message));

			}

		}

		return new ViewModel(array('form' => $form));

	}

    /*
    	- forgotten password -
		from login form (auth)
    */
    public function forgottenPasswordAction(){

		$form = new ForgottenPasswordForm();

		$request = $this->getRequest();

		if ($request->isPost()) {

			$form->setInputFilter(new ForgottenPasswordFilter($this->getServiceLocator()));
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$data = $form->getData();
				
				$usr_email = $data['usr_email'];

				$usersTable = $this->getUsersTable();
				
				$auth = $usersTable->getUserByEmail($usr_email);

				$password = $this->generatePassword();

				$auth->password = $this->encriptPassword($this->getStaticSalt(), $password, $auth->password_salt);
				//$usersTable->changePassword($auth->usr_id, $password);
				// or

				$usersTable->saveUser($auth);
				$this->sendPasswordByEmail($usr_email, $password);
				$this->flashMessenger()->addMessage($usr_email);
				//return $this->redirect()->toRoute('user', array('controller'=>'user', 'action'=>'index'));

				$view_message = "La solicitud de restablecimiento de contraseña ha sido enviada a <span id='email-dest'>".$usr_email."</span>.<br />
					Por favor, compruebe su buzón de entrada y regrese a la página de inicio de sesión.";

				return new ViewModel(array('form' => $form, 'message' => $view_message));
			}
		}
		return new ViewModel(array('form' => $form));

	}

	//sending new password by email
	//error expected!
	public function sendPasswordByEmail($usr_email, $password){
		$message = new Message();

		$this->getRequest()->getServer(); //Server vars

		$html_message = '<html>
							<head>
								<meta charset="UTF-8">
							</head>
							<body bgcolor="#F5F5F5" style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%!important; height: 100%;background-color: #F5F5F5;">
							<div style="width: 600px;margin: 0 auto;">

							<table class="head-wrap" bgcolor="#013765" style="width: 600px;margin:0 auto;">
								<tr>
									<td></td>
									<td class="header container" style="max-width:600px!important;padding: 15px;">
										
											<div class="content" style="padding:15px;max-width:600px;margin:0 auto;display:block;">
												<table style="width: 100%;">
												<tr>
													<td align="center"><img src="http://localhost/repositories/catalogourrea/public/img/urrea_logo.png" /></td>
												</tr>
											</table>
											</div>
											
									</td>
									<td></td>
								</tr>
							</table>
							<table class="body-wrap" style="width: 600px;margin:0 auto;background: #FFF;">
								<tr>
									<td></td>
									<td class="container" bgcolor="#FFFFFF" style="display:block!important;max-width:600px!important;margin:0 auto!important; /* makes it centered */clear:both!important;">

										<div class="content" style="padding: 70px;max-width:600px;margin:0 auto;display:block;">
										<table>
											<tr>
												<td>
													<p style="margin-bottom: 10px;font-weight: normal;font-size:14px; line-height:1.6;text-align: left;">Tu nueva contraseña de <strong>Catálogo URREA</strong> ha sido restaurada.</p>
													
													<p class="callout" style="margin-bottom: 10px;font-weight: normal;font-size:14px; line-height:1.6;text-align: justify;padding:15px;background-color:#F5F5F5;margin-bottom: 15px;">
														Tu nueva contraseña es: <strong>'.$password.'</strong>
													</p>
													
													<p style="margin-bottom: 10px;font-weight: normal;font-size:14px; line-height:1.6;text-align: left;">Por favor inicia sesión nuevamente con ésta contraseña. Porsteriormente podrás personalizarla en la sección de usuario.</p>
							                        <p style="margin-bottom: 10px;font-weight: normal;font-size:14px; line-height:1.6;text-align: left;">Si tienes algun problema o necesitas ayuda puedes enviar un correo a  
							                            <a href="mailto:programacion@hoppercat.com">programacion@hoppercat.com</a> y solicitar ayuda técnica.
							                            .</p>
												</td>
											</tr>
										</table>
										</div>
																
									</td>
									<td></td>
								</tr>
							</table>
							</div>
							</body>
							</html>';

		$html = new MimePart($html_message);
		$html->type = "text/html";

		$body = new MimeMessage();
		$body->setParts(array($html));

		$message->addTo($usr_email)
			->addFrom('catalogoapp@urrea.mx')
			->setSubject('Tu contraseña ha sido cambiada!')
			->setBody($body);

		$transport = new SendmailTransport();

		$transport->send($message);	
	}

	//generating new dynamic salt
	public function generateDynamicSalt(){
		$dynamicSalt = '';
		for ($i = 0; $i < 50; $i++) {
			$dynamicSalt .= chr(rand(33, 126));
		}
		return $dynamicSalt;
	}

	//getting user static salt
	public function getStaticSalt(){
		$staticSalt = '';
		$config = $this->getServiceLocator()->get('Config');
		$staticSalt = $config['static_salt'];
		return $staticSalt;
	}

	//encriptation password function
	public function encriptPassword($staticSalt, $password, $dynamicSalt){
		return $password = md5($staticSalt . $password . $dynamicSalt);
	}

	//generate password function
	public function generatePassword($l = 8, $c = 0, $n = 0, $s = 0) {

		// get count of all required minimum special chars
		$count = $c + $n + $s;
		$out = '';

		// sanitize inputs; should be self-explanatory
		if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
			trigger_error('Argument(s) not an integer', E_USER_WARNING);
			return false;
		}elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
			trigger_error('Argument(s) out of range', E_USER_WARNING);
			return false;
		}elseif($c > $l) {
			trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
			return false;
		}elseif($n > $l) {
			trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
			return false;
		}elseif($s > $l) {
			trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
			return false;
		}elseif($count > $l) {
			trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
			return false;
		}

		// all inputs clean, proceed to build password
		// change these strings if you want to include or exclude possible password characters
		$chars = "abcdefghijklmnopqrstuvwxyz";
		$caps = strtoupper($chars);
		$nums = "0123456789";
		$syms = "!@#$%^&*()-+?";

		// build the base password of all lower-case letters
		for($i = 0; $i < $l; $i++) {
			$out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}

		// create arrays if special character(s) required
		if($count) {

			// split base password to array; create special chars array
			$tmp1 = str_split($out);
			$tmp2 = array();
			
			// add required special character(s) to second array
			for($i = 0; $i < $c; $i++) {
				array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
			}

			for($i = 0; $i < $n; $i++) {
				array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
			}

			for($i = 0; $i < $s; $i++) {
				array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
			}

			// hack off a chunk of the base password array that's as big as the special chars array
			$tmp1 = array_slice($tmp1, 0, $l - $count);
			
			// merge special character(s) array with base password array
			$tmp1 = array_merge($tmp1, $tmp2);
			
			// mix the characters up
			shuffle($tmp1);
			
			// convert to string for output
			$out = implode('', $tmp1);
		}

		return $out;
	}



}