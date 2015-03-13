<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{    
    public function indexAction(){
    	
    	$user_profile_srv = $this->getServiceLocator()->get('user_profile_service');
    	$user_id = $this->zfcUserAuthentication()->getIdentity()->getId();
    	$profile_id = $this->zfcUserAuthentication()->getIdentity()->getGid();

        $profile_completed = $user_profile_srv->getUserInfo($user_id);

        if(!$profile_completed && $profile_id != 1){
            $this->redirect()->toRoute('complete');
        }

        $cscategorycmf_category = $this->getServiceLocator()
                ->get('core_service_cmf_category');
        $categories = $cscategorycmf_category->getCategory()->getCategories();
    	
        return new ViewModel(array('categories' => $categories));
    }

    protected function _predump($arg){
    	echo "<pre>";
    	var_dump($arg);
    	echo "</pre>";
    	die;
    }
}
