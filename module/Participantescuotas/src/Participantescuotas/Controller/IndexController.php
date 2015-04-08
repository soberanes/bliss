<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Participantescuotas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Headers;
use Zend\Http\Response\Stream;
use Participantes\Form\ParticipantesForm;
use Participantes\Form\ParticipantesValidator;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController{
    
    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }
    
    public function indexAction() {
        $participantes_service = $this->getServiceLocator()->get('participantes_service');

        $participantes = $participantes_service->getParticipantes(null, 2);

        return new ViewModel(array(
            'participantes' => $participantes,
            'count' => $participantes->count()
        ));
    }

    public function asignarCuotaAction(){
    	$participantes_service = $this->getServiceLocator()->get('participantes_service');
    	$cuotas_service 	   = $this->getServiceLocator()->get('cuotas_service');
    	$sucursales_service    = $this->getServiceLocator()->get('sucursales_service');

    	$participante_id   = (int) $this->params()->fromRoute('id', 0);

    	$participante_data = $participantes_service->getParticipanteById($participante_id);
    	$sucursal_data	   = $sucursales_service->getSucursal($participante_data->sucursal_id);

    	$cuotas_f = $cuotas_service->getCuotasForParticipantF($participante_id);
    	$cuotas_a = $cuotas_service->getCuotasForParticipantA($participante_id);

    	$meses = $cuotas_service->getMonths();

    	return new ViewModel(array(
    		"participante" => $participante_data,
    		"sucursal" 	   => $sucursal_data->nombre,
    		"cuotas_f"	   => $cuotas_f,
    		"cuotas_a"	   => $cuotas_a,
    		"meses_txt"	   => $meses,
    	));
    }

    public function saveCuotaAction(){
    	$cuotas_service = $this->getServiceLocator()->get('cuotas_service');
    	$request = $this->getRequest();
    	$error   = null;
    	$detalle = null;

    	if($request->isPost()){

    		$data  = $request->getPost();
    		$saved = $cuotas_service->saveCuota($data);

    		if($saved){
	    		$error = 100;
	    		$detalle = "Los datos han sido guardados con éxito.";
    		}else{
    			$error = 102;
	    		$detalle = "Ha ocurrido un error al guardar los datos. Intente nuevamente.";
    		}

    	}else{
    		$error = 101;
    		$detalle = "Los datos no son compatibles.";
    	}

    	$response = new JsonModel(array('err' => $error, 'detalle' => $detalle));

        return $response;
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
}