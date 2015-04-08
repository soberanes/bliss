<?php
namespace Sucursales\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
use Sucursales\Form\SucursalesForm;
use Sucursales\Form\SucursalesValidator;

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
        $sucursales_service     = $this->getServiceLocator()->get('sucursales_service');
        $distribuidores_service = $this->getServiceLocator()->get('distribuidores_service');
        $distribuidores = $distribuidores_service->getDistribuidores();
        $sucursales     = $sucursales_service->getSucursales();

        return new ViewModel(array(
            'distribuidores' => $distribuidores,
            'sucursales'     => $sucursales
        ));
    }
    
    public function nuevaSucursalAction(){
        $sucursales_service = $this->getServiceLocator()->get('sucursales_service');
        $success = false;
        $form = new SucursalesForm();
        $form->get('distribuidor')->setAttribute('options' ,$sucursales_service->getOptionsForSelect('distribuidores'));
        
        $request = $this->getRequest();

        if($request->isPost()){
            //Getting data
            $form_data = $request->getPost()->toArray();

            //validate
            $formValidator = new SucursalesValidator();
            $form->setInputFilter($formValidator->getInputFilter());

            $form->setData($form_data);

            if($form->isValid()){
                $sucursales_service->saveSucursal($form_data);
                return $this->redirect()->toRoute('sucursales');
            }else{
                $errors  = $form->getMessages();
                $form->setMessages($errors);
            }
        }

        return array(
            'success' => $success,
            'form'    => $form
        );
    }

    public function editarSucursalAction(){
        $sucursales_service = $this->getServiceLocator()->get('sucursales_service');
        $request = $this->getRequest();
        $sucursal_id = (int) $this->params()->fromRoute('id', 0);
        $sucursal_data = $sucursales_service->getSucursal($sucursal_id);

        $form = new SucursalesForm();
        $form->get('distribuidor')->setAttribute('options' ,$sucursales_service->getOptionsForSelect('distribuidores'));
        $form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
        $form->bind($sucursal_data);

        if($request->isPost()){
            $form_data = $request->getPost()->toArray();
            $formValidator = new SucursalesValidator();

            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($form_data);

            if($form->isValid()){
                $sucursales_service->saveSucursal($form_data, "update");
                return $this->redirect()->toRoute('sucursales');
            }else{
                $errors  = $form->getMessages();
                $form->setMessages($errors);
            }
        }

        return new ViewModel(array(
            "sucursal" => $sucursal_data->nombre,
            "form" => $form
        ));
    }

    public function eliminarSucursalAction(){
        $sucursales_service = $this->getServiceLocator()->get('sucursales_service');
        
        $sucursal_id =  (int) $this->params()->fromRoute('id', 0);
        if(!$sucursal_id){
            return $this->redirect()->toRoute('sucursales');
        }
        
        $request = $this->getRequest();
        if($request->isPost()){
            $del = $request->getPost('del');
            
            if($del == 'Eliminar'){
                $id = (int) $request->getPost('id');
                $sucursales_service->deleteSucursal($id);
            }

            return $this->redirect()->toRoute('sucursales');
        }

        return array(
            'sucursal_id' => $sucursal_id,
            'sucursal'    => $sucursales_service->getSucursal($sucursal_id),
        );
    }
}