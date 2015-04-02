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
        $participantes_service = $this->getServiceLocator()->get('participantes_service');

        $participantes = $participantes_service->getParticipantes();

        return new ViewModel(array(
            'participantes' => $participantes,
            'count' => $participantes->count()
        ));
    }
    
    public function searchResultAction(){
        $participantes_service = $this->getServiceLocator()->get('participantes_service');

        $request = $this->getRequest();
        if($request->isPost()){
            $data = $request->getPost()->toArray();
            
            $search_result = $participantes_service->searchParticipante($data['search-filter']);
            
            return new ViewModel(array(
                'participantes' => $search_result,
                'count' => $search_result->count()
            ));


        }else{
            $this->getResponse()->setStatusCode(404);
            return;
        }   
    }

    public function nuevoParticipanteAction(){
        die('nuevo participante');
    }

}