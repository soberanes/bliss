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
use Participantes\Form\ParticipantesForm;
use Participantes\Form\ParticipantesValidator;

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
        $participantes_service = $this->getServiceLocator()->get('participantes_service');

        $form = new ParticipantesForm();
        $form->get('estado')->setAttribute('options', $participantes_service->getEstadosOptions());
        $form->get('parent')->setAttribute('options', $participantes_service->getParentsOptions());
        $form->get('sucursal')->setAttribute('options', $participantes_service->getSucursalesOptions());

        $request = $this->getRequest();
        if($request->isPost()){
            $form_data = $request->getPost()->toArray();
            $formValidator = new ParticipantesValidator();
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($form_data);

            if($form->isValid()){
                $participantes_service->saveParticipante($form_data);
                return $this->redirect()->toRoute('participantes');
            }else{
                $errors  = $form->getMessages();
                $form->setMessages($errors);
            }
        }

        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editarParticipanteAction(){
        date_default_timezone_set('America/Mexico_City');
        $participantes_service = $this->getServiceLocator()->get('participantes_service');
        $request = $this->getRequest();
        $participante_id   = (int) $this->params()->fromRoute('id', 0);
        $participante_data = $participantes_service->getParticipanteById($participante_id);

        $form = new ParticipantesForm();
        $form->get('estado')->setAttribute('options' ,$participantes_service->getEstadosOptions());
        $form->get('parent')->setAttribute('options' ,$participantes_service->getParentsOptions());
        $form->get('sucursal')->setAttribute('options', $participantes_service->getSucursalesOptions());

        $form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
        
        if(isset($participante_data->birthdate)){
            $participante_data->birthdate = date('d/m/Y', strtotime($participante_data->birthdate));
        }

        $form->bind($participante_data);
        $form->get('perfil')->setAttributes(array('value'=>$participante_data->perfil,'selected'=>true));
        $form->get('estado')->setAttributes(array('value'=>$participante_data->estado,'selected'=>true));
        $form->get('parent')->setAttributes(array('value'=>$participante_data->parent_id,'selected'=>true));
        $form->get('sucursal')->setAttributes(array('value'=>$participante_data->sucursal_id,'selected'=>true));

        if($request->isPost()){
            $form_data = $request->getPost()->toArray();
            $formValidator = new ParticipantesValidator();
            
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($form_data);

            if($form->isValid()){
                $participantes_service->saveParticipante($form_data, "update");
                return $this->redirect()->toRoute('participantes');
            }else{
                $errors  = $form->getMessages();
                $form->setMessages($errors);
            }
        }

        return new ViewModel(array(
            "participante" => $participante_data->fullname,
            "form" => $form
        ));
    }

    public function eliminarParticipanteAction(){
        $participantes_service = $this->getServiceLocator()->get('participantes_service');
        
        $participante_id =  (int) $this->params()->fromRoute('id', 0);
        if(!$participante_id){
            return $this->redirect()->toRoute('participantes');
        }
        
        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del');
            
            if($del == 'Eliminar'){
                $id = (int) $request->getPost('id');
                $participantes_service->deleteParticipante($id);
            }

            return $this->redirect()->toRoute('participantes');
        }

        return array(
            'participante_id' => $participante_id,
            'participante'    => $participantes_service->getParticipanteById($participante_id),
        );
    }

}