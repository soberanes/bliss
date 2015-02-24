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
use Registro\Form\Complete;

class IndexController extends AbstractActionController
{    

    public function indexAction(){

    	$request = $this->getRequest();
        $user_profile_srv = $this->getServiceLocator()->get('user_profile_service');
        $message = null;

		$profile_id = $this->zfcUserAuthentication()->getIdentity()->getGid();
        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
       	
        $form = new Complete();

        if($request->isPost()){
            /* saving data into user_info */
            $data = $request->getPost();
            
            $user_saved = $user_profile_srv->createUser($data, $user_id);

            if($user_saved){
                $this->redirect()->toRoute('success');
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
        $request = $this->getRequest();
        $user_profile_srv = $this->getServiceLocator()->get('user_profile_service');


        $profile_id = $this->zfcUserAuthentication()->getIdentity()->getGid();
        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
        
        $form = new Complete();

        if($request->isPost()){
            /* saving data into user_info */
            $data = $request->getPost();
            
            $user_saved = $user_profile_srv->saveUserInfo($data, $user_id, $profile_id);

            if($user_saved){
                return $this->redirect()->toRoute('home');
            }
        }
        
        $layout = $this->layout();
        $layout->setTemplate('layout/complete');
    
        return new ViewModel(array(
            "form"       => $form
        ));
    }

    protected function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }
}   	