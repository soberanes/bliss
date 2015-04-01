<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Participantes\Controller;

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
        date_default_timezone_set('America/Mexico_City');
        // $form = $this->get('ventas_uploader_form');
        // $gerente = $this->getGerente();

        // $user_service = $this->getServiceLocator()->get('user_profile_service');


        return new ViewModel(array(
            //'usuarios' => $usuarios
        ));
    }
    
}