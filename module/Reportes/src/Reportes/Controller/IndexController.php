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
    
	protected $pesos = 6.4;
	
    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }
    
    public function indexAction() {
        $reporte_service = $this->getServiceLocator()->get('reporte_service');
        return new ViewModel();
    }
	
	public function ventasAction(){
		$reporte_service = $this->getServiceLocator()->get('reporte_service');
		
		$header = array(
		    'Figura',
		    'Distribuidor',
		    'Sucursal',
		    'Nombre',
		    'Marca',
		    'Familia',
		    'SKU Participante',
		    '# Piezas',
		    'Puntos ganados',
		    'Puntos ganados en pesos',
		);
		
		$report = $reporte_service->getVentasReport();
		$records = array();
		
		
		foreach ($report as $venta) {
			
			array_push($records, 
				array(
			        $venta["figura"],
			        $venta["distribuidor"],
			        $venta["sucursal"],
			        $venta["nombre"],
			        "No aplica",
			        $venta["familia"],
			        "No aplica",
			        $venta["venta"],
			        $venta["puntos"],
			        $venta["puntos"]*$this->pesos,
			    ));
		}
		
		return $this->csvExport('master-ventas.csv', $header, $records);	
	}
	
	public function cuentasAction(){
		$reporte_service = $this->getServiceLocator()->get('reporte_service');
		
		$header = array(
				'Nombre distribuidor',
				'Puesto',
				'nombre participante',
				'Email',
				'Telefono',
				'Celular',
				'Domicilio',
				'Ciudad/Municipio',
				'Estado',
				'Codigo postal',
				'Referencias',
				'Fecha de nacimiento',
				'Usuario',
				'contrasena',
				'Ultima sesion',
		);
		
		$familias = $reporte_service->getFamilias();
		$x=0;
		foreach ($familias as $familia) {
			
			if($familia["categoria"] == 2 && $x == 0){
				array_push($header, '% cumplimiento');
				$x = 1;
			}
			array_push($header,$familia["nombre"]);
		}
		
		array_push($header, '% cumplimiento');
				
		array_push($header,
			'Cuota anual ventas',
			'Acumulado anual ventas',
			'% cumplimiento',
			'Puntos acumulados',
			'Puntos canjeados',
			'Puntos disponibles'
		);
		
		$records = array();
		 
		$usuarios = $reporte_service->getCuentasReport();
		
		foreach ($usuarios as $user) {
			
			$user_data = $reporte_service->getUserData($user["user_id"]);
			
			array_push($records, 
				array(
			        @$user_data->distribuidor_nombre,
			        $user["perfil"],
			        @$user_data->fullname,
			        @$user_data->email,
			        @$user_data->phone,
			        @$user_data->cellphone,
			        @$user_data->address,
			        @$user_data->municipio,
			        @$user_data->estado,
			        @$user_data->zip_code,
			        "",
			        $user["username"],
			        $user["password"],
			        "",
			        //ciclo por familias y cuotas!!! 
			    ));
		}
	
		$this->_predump($records);
		
		return $this->csvExport('master-usuarios-edo-cuenta.csv', $header, $records);
	}
}