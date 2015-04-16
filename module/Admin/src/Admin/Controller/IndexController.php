<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Ventas\Form\VentasUploader;

class IndexController extends AbstractActionController {

    public function indexAction() {
        
        $general_service = $this->getServiceLocator()->get('general_service');
        
        // $this->_predump($sucursales_data);

        return new ViewModel();

    }

    public function adminSalesAction() {
        
        $general_service = $this->getServiceLocator()->get('general_service');
        
        // $this->_predump($sucursales_data);

        return new ViewModel();

    }

    public function aplicacionesAction(){
        date_default_timezone_set('America/Mexico_City');
        $general_service = $this->getServiceLocator()->get('general_service');
        $form = new VentasUploader();
        $form->get('month')->setAttributes(array('value' => date('m'),'selected' => true));

        $encargados = $general_service->getEncargados();
        
        return new ViewModel(array(
            'form'    => $form,
            "encargados" => $encargados
        ));
    }

    public function uploadAction(){        
        $file_service    = $this->getServiceLocator()->get('uploader_service');
        $general_service = $this->getServiceLocator()->get('general_service');
        
        $request = $this->getRequest();
        $error = -1;
        $detalle = null;

        if ($request->isPost()) {
            

            $filename = $file_service->uploadFileApps($request);
            $process = $general_service->processFile($request->getPost(), $filename);
            
            $error = 1;
            $detalle = "El archivo ha sido cargado y procesado con éxito.";
        }

        return new ViewModel(array(
            'err' => $error, 
            'detalle' => $detalle
        ));

        return $response;
    }

    public function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }

}