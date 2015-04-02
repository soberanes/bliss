<?php
namespace Sucursales\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
use Sucursales\Form\DistribuidoresForm;
use Sucursales\Form\DistribuidoresValidator;

class DistController extends AbstractActionController{
    
    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }

    public function indexAction(){
    	return $this->redirect()->toRoute('sucursales');
    }

    public function nuevoDistribuidorAction(){
    	$distribuidores_service = $this->getServiceLocator()->get('distribuidores_service');

    	$form = new DistribuidoresForm();
    	$request = $this->getRequest();

    	if($request->isPost()){
            $form_data = $request->getPost()->toArray();
            $formValidator = new DistribuidoresValidator();
            $form->setInputFilter($formValidator->getInputFilter());

            $form->setData($form_data);
            if($form->isValid()){
                $distribuidores_service->saveDistribuidor($form_data);
                return $this->redirect()->toRoute('sucursales');
            }else{
                $errors  = $form->getMessages();
                $form->setMessages($errors);
            }
    	}

    	return array(
            'form'    => $form
        );

    }

    public function editarDistribuidorAction(){
        $distribuidores_service = $this->getServiceLocator()->get('distribuidores_service');
        $request = $this->getRequest();
        $distribuidor_id   = (int) $this->params()->fromRoute('id', 0);
        $distribuidor_data = $distribuidores_service->getDistribuidor($distribuidor_id);

        $form = new DistribuidoresForm();
        $form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
        $form->bind($distribuidor_data);

        if($request->isPost()){
            $form_data = $request->getPost()->toArray();
            $formValidator = new DistribuidoresValidator();

            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($form_data);

            if($form->isValid()){
                $distribuidores_service->saveDistribuidor($form_data, "update");
                return $this->redirect()->toRoute('sucursales');
            }else{
                $errors  = $form->getMessages();
                $form->setMessages($errors);
            }
        }

        return new ViewModel(array(
            "distribuidor" => $distribuidor_data->nombre,
            "form" => $form
        ));
    }

    public function eliminarDistribuidorAction(){
        $distribuidores_service = $this->getServiceLocator()->get('distribuidores_service');
        
        $distribuidor_id =  (int) $this->params()->fromRoute('id', 0);
        if(!$distribuidor_id){
            return $this->redirect()->toRoute('sucursales');
        }
        
        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del');
            
            if($del == 'Eliminar'){
                $id = (int) $request->getPost('id');
                $distribuidores_service->deleteDistribuidor($id);
            }

            return $this->redirect()->toRoute('sucursales');
        }

        return array(
            'distribuidor_id' => $distribuidor_id,
            'distribuidor'    => $distribuidores_service->getDistribuidor($distribuidor_id),
        );
    }
    
}