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
}