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

        return new ViewModel(array(
        	'sucursales_data' => $sucursales_data,
        	'months_collection' => $months
        ));

    }

    public function notifyUserAction(){
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

    public function _predump($arg){
    	echo "<pre>";
    	var_dump($arg);
    	echo "</1pre>";
    	die;
    }

}
