<?php

namespace Cscore\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Categoryhelper extends AbstractHelper
{
    protected $sm;  


    public function setSm($sm){

        $this->sm = $sm;    
    }
    
    public function getSm(){ 
        return $this->sm;    
    }
    
    public function __invoke(){
        $router = $this->sm->get('router');
        $request = $this->sm->get('request');
        $routeMatch = $router->match($request);
        return $routeMatch->getParam('cat', 1);  
    }
}