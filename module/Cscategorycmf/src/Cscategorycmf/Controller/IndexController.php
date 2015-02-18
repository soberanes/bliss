<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cscategorycmf\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController{
    
    public function indexAction(){
        $cscategorycmf_category = $this->getServiceLocator()
                ->get('core_service_cmf_category');
        $categories = $cscategorycmf_category->getCategory()->getCategories();        
        return new ViewModel(array('categories'=>$categories));        
    }    
}
