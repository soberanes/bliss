<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Reportes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;

class IndexController extends AbstractActionController{
    
    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }
    
    public function indexAction() {
        $reporte_service = $this->getServiceLocator()->get('reporte_service');

        return new ViewModel(array(

        ));
    }

}