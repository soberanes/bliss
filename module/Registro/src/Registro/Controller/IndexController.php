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
		$options_select = $user_profile_srv->getSelectOptions();
		
		$profile_id = $this->zfcUserAuthentication()->getIdentity()->getGid();
        $user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
       	
        $form = new Complete();
		$form->get('estado')->setAttribute('options' ,$options_select);
        
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
            "form"       => $form,
            "profile_id" => $profile_id,
            "profile"    => $profile
        ));
	}
}   	