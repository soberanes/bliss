<?php

namespace Marketing\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        
        $marketing_service = $this->getServiceLocator()->get('marketing_service');
        
        $sucursales_data = $marketing_service->getSucursalesData();
        //$this->_predump($sucursales_data);
        $months = array(
        	1  => 'Enero',
        	2  => 'Febrero',
        	3  => 'Marzo',
        	4  => 'Abril',
        	5  => 'Mayo',
        	6  => 'Junio',
        	7  => 'Julio',
        	8  => 'Agosto',
        	9  => 'Septiembre',
        	10 => 'Octubre',
        	11 => 'Noviembre',
        	12 => 'Diciembre',
        );
		
		// $this->_predump($sucursales_data);

        return new ViewModel(array(
        	'sucursales_data' => $sucursales_data,
        	'months_collection' => $months
        ));

    }

    public function notifyUserAction(){
        $marketing_service = $this->getServiceLocator()->get('marketing_service');
    	$user_profile_srv = $this->getServiceLocator()->get('user_profile_service');
    	$mail_sender = $this->getServiceLocator()->get('mailer_sender_service');

    	$request = $this->getRequest();

    	if($request->isPost()){
    		$post = $request->getPost();

			$profile_data = $user_profile_srv->getUserInfoProfile($post["user_id"]);

		    $data = array(
		    	"display_name" => $profile_data->getFullName(),
		    	"email" 	   => $profile_data->getEmail(),
		    	"message" 	   => "Es necesario que vuelva a cargar el archivo con sus ventas."
		    );

            //change data_loaded status
            $marketing_service->deactivateDataLoaded($post["user_load"]);
		    
		    if($mail_sender->sendMailLoad($data)){
		    // if(true){
	    		$code 	 = 200;
	    		$message = "Mensaje enviado correctamente";
			}else{
				$code 	 = 204;
	    		$message = "Ha ocurrido un error al enviar el mensaje";
			}

    	}else{
    		$code 	 = 201;
    		$message = "Ha ocurrido un error.";
    	}
        
		$result = new JsonModel(array(
		    'code' 	  => $code,
	        'message' => $message,
	    ));
        return $result;
    	
    }

	public function validateAction(){

        date_default_timezone_set('America/Mexico_City');
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $dataloadedDao = $this->getServiceLocator()->get('Uploader/Model/DataLoadedDao');
        $mecanica_service = $this->getServiceLocator()->get('mecanica_acumulacion');

        $request = $this->getRequest();
        if($request->isPost()){
            $post = $request->getPost();
            $data_id = $post['data_load'];
            $dataLoadObj = $dataloadedDao->getById($data_id);
            
            $response = $mecanica_service->process($dataLoadObj);
        }


        return new JsonModel(array(
            "response"  => $response,
            "process_d" => date('d-m-Y'),
        ));
	}

    public function downloadAction() {

        $archivo_id = (int) $this->params()->fromRoute('file', 0);
        $uploader_service = $this->getServiceLocator()->get('uploader_service');

        $archivo = $uploader_service->getModArchivo($archivo_id);

        $document = substr(str_replace('%2F', '/', $archivo->getFilename()), 1);
        //$this->_predump($document);
        
        $response = new \Zend\Http\Response\Stream();
        $response->setStream(fopen($document, 'r'));
        $response->setStatusCode(200);

        $headers = new \Zend\Http\Headers();
        $headers->addHeaderLine('Content-Type', 'xls')
                ->addHeaderLine('Content-Disposition', 'attachment; filename="' . $document . '"')
                ->addHeaderLine('Content-Length', filesize($document));

        $response->setHeaders($headers);
        return $response;

    }

    public function _predump($arg){
    	echo "<pre>";
    	var_dump($arg);
    	echo "</1pre>";
    	die;
    }

}
