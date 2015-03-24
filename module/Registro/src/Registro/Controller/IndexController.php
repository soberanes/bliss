<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Registro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Registro\Form\Registro;
use Registro\Form\Complete;
use Cshelperzfcuser\Model\Entity\User;
use Cshelperzfcuser\Model\Entity\UserInfo;
use Registro\Form\CompleteValidator;
use Registro\Form\RegistroValidator;
use Registro\Controller\Plugin\StringsPlugin as StringsPlugin;

class IndexController extends AbstractActionController
{    

    public function indexAction(){

    	$request = $this->getRequest();
        $user_profile_srv = $this->getServiceLocator()->get('user_profile_service');
        $strings = new StringsPlugin();
        $message = null;

		$profile_id = $this->zfcUserAuthentication()->getIdentity()->getGid();
        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
       	
        $form = new Registro();

        if($request->isPost()){
            /* saving data into user_info */
            $formValidator = new RegistroValidator();
            $form->setInputFilter($formValidator->getInputFilter());
            $data = $request->getPost();

            $form->setData($data);

            if($form->isValid()){

                $data->fullname = $strings->str_sanitize($data->fullname);
                $user_saved = $user_profile_srv->createUser($data, $user_id);

                if($user_saved){
                    $this->redirect()->toRoute('success');
                }else{
                    $form->get('fullname')->setMessages(array('Ya existe ese username en los registros. Por favor envía de nuevo el formulario.'));
                }
            }else{
                $errors = $form->getMessages();
                $form->setMessages($errors);
            }

        }
     	
		// $layout = $this->layout();
        // $layout->setTemplate('layout/complete');
	
        return new ViewModel(array(
            "form"    => $form
        ));
	}

    public function successAction(){
        $message = "El vendedor fue guardado con éxito";

        return new ViewModel(array(
           "message" => $message 
        ));
    }

    public function completeAction(){
        date_default_timezone_set('America/Mexico_City');
        $request = $this->getRequest();
        $user_profile_srv = $this->getServiceLocator()->get('user_profile_service');

        $profile_id = $this->zfcUserAuthentication()->getIdentity()->getGid();
        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        
        $profile_data = $user_profile_srv->getUserInfoProfile($user_id);

        // $user = new UserInfo();
        $user = new \stdClass();

        $user->fullname  = $profile_data->getFullname();
        $user->email     = $profile_data->getEmail();
        $user->phone     = $profile_data->getPhone();
        $user->cellphone = $profile_data->getCellphone();
        $user->birthdate = date('d/m/Y', $profile_data->getBirthdate());

        $form = new Complete();
        $form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
        $form->bind($user);

        if($request->isPost()){
            /* saving data into user_info */

            //validate
            $formValidator = new CompleteValidator();
            $form->setInputFilter($formValidator->getInputFilter());

            $data = $request->getPost();

            $form->setData($data);

            if($form->isValid()){
				
				// $this->_predump($user);
                $user_saved = $user_profile_srv->updateUserInfo($data, $user_id, 1, $profile_id);
                
                if($user_saved){
                    return $this->redirect()->toRoute('home');
                }
            }else{
                $errors  = $form->getMessages();
                // $this->_predump($errors);
                $form->setMessages($errors);
            }

        }
        
        $layout = $this->layout();
        $layout->setTemplate('layout/complete');
    
        return new ViewModel(array(
            "form"       => $form
        ));
    }

    public function importAction(){
        $registro_service = $this->getServiceLocator()->get('registro_service');
        $csv = $this->csvImport('data/encargados.csv');
        $i = 0;

        foreach ($csv as $row){
            $registro_service->guardaEncargado($row, $i++);
        }

        die('import finished..');
    }

    protected function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }
}   	