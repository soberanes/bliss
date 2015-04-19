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
	
	/**
	 * Genera el reporte de estado de cuenta de usuarios.
	 *
	 */
	public function cuentasAction(){
		date_default_timezone_set("America/Mexico_City");
		$reporte_service = $this->getServiceLocator()->get('reporte_service');
		
		$header = array(
				'Nombre distribuidor',
				'Sucursal',
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
			array_push($header, '% cumplimiento');
		}
		
				
		array_push($header,
			//'Cuota anual ventas',
			'Acumulado anual ventas',
			'% cumplimiento',
			'Puntos acumulados',
			'Puntos canjeados',
			'Puntos disponibles'
		);
		
		$records = array();
		 
		$usuarios = $reporte_service->getCuentasReport();
		$i = 0;
		
		foreach ($usuarios as $user) {
			$i++;
			$user_data = $reporte_service->getUserData($user["user_id"]);
			
			$familias2 = $reporte_service->getFamilias();
			$c_anual = 0;
			foreach ($familias2 as $key => $value) {
	        	$cuotas_id[$key] = $value["familia_id"];
	        	$cuotas[$key] = $reporte_service->getCuotaTotalFamilia($value["familia_id"],$value["categoria"], $user["user_id"]);
				$c_anual += $cuotas[$key];
			}

			array_push($records, 
				array(
			        @$user_data->distribuidor_nombre,
			        @$user_data->sucursal_nombre,
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
			        @date("d/m/Y",$user_data->birthdate),
			        $user["username"],
			        $reporte_service->getUserControl($user["user_id"])->password_text,
			        "",
			        $cuotas[0],
			        $reporte_service->getCumplimiento($user["user_id"], 1, $cuotas_id[0]),
			        $cuotas[1],
			        0,
			        $cuotas[2],
			        0,
			        $cuotas[3],
			        0,
			        $cuotas[4],
			        0,
			        $cuotas[5],
			        0,
			        // $reporte_service->getCumplimiento($user["user_id"],1),
			        $cuotas[6],
			        0,
			        $cuotas[7],
			        0,
			        $cuotas[8],
			        0,
			        $cuotas[9],
			        0,
			        $cuotas[10],
			        0,
			        $cuotas[11],
			        0,
			        $cuotas[12],
			        // $reporte_service->getCumplimiento($user["user_id"],2),
			        // cuota anual
			        // $c_anual,
			        // venta anual
			        $v_anual = $reporte_service->getVentaAnual($user["user_id"]),
			        // % cumplimiento
			        $reporte_service->getDivisionCuota($v_anual,$c_anual),
			        // @($v_anual*100)/$c_anual,
			        // puntos acumulados
			        $reporte_service->getPuntos($user["user_id"])->ganados,
			        // puntos canjeados
			        $reporte_service->getPuntos($user["user_id"])->canjeados,
			        // puntos disponibles
			        $reporte_service->getPuntos($user["user_id"])->actuales,
			    ));
			
			if($i== 100){
				break;
			}
		}
		
		return $this->csvExport('master-usuarios-edo-cuenta.csv', $header, $records);
	}

	public function usuariosAction(){
		date_default_timezone_set("America/Mexico_City");
		$reporte_service = $this->getServiceLocator()->get('reporte_service');
		
		$header = array(
				'Ocupacion',
				'Nombre distribuidor',
				'Puesto',
				'Nombre completo',
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
				'Ultima sesion',
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
			
			$familias2 = $reporte_service->getFamilias();
			$c_anual = 0;
			foreach ($familias2 as $key => $value) {
	        	$cuotas[$key] = $reporte_service->getCuotaTotalFamilia($value["familia_id"],$value["categoria"], $user["user_id"]);
				$c_anual += $cuotas[$key];
			}

			array_push($records, 
				array(
					"",
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
			        @date("d/m/Y",$user_data->birthdate),
			        $user["username"],
			        "",
			        $c_anual,
			        $v_anual = $reporte_service->getVentaAnual($user["user_id"]),
			        $reporte_service->getDivisionCuota($v_anual,$c_anual),
			        $reporte_service->getPuntos($user["user_id"])->ganados,
			        $reporte_service->getPuntos($user["user_id"])->canjeados,
			        $reporte_service->getPuntos($user["user_id"])->actuales,
		    ));
		}
		
		return $this->csvExport('master-usuarios.csv', $header, $records);
	}

	public function canjesAction(){
		date_default_timezone_set("America/Mexico_City");
		$reporte_service = $this->getServiceLocator()->get('reporte_service');
		$canjes_service  = $this->getServiceLocator()->get('canjes_service');

		$header = array(				
				'No. canje',
				'Nombre del Ganador',
				'Usuario',
				'Id unico ganador',
				'Codigo PMR',
				'Codigo CU',
				'Descripcion articulo',
				'Cantidad',
				'Precio articulo moneda PMR',
				'Precio articulo (Pesos)',
				'Domicilio entrega',
				'CP',
				'Referencias',
				'Horario entrega',
				'Nombre de la persona de entrega',
				'Telefono de la persona de entrega',
				'Email contacto entrega',
				'Fecha seleccion del premio',
				'Horario Canje',
				'Nombre del producto'

		);

		$records = array();
		$canjes = $canjes_service->canjes();

		foreach ($canjes as $canje) {

			array_push($records, 
				array(
					$canje["order_id"],
					$canje["fullname"],
					$canje["username"],
					$canje["user_id"],
					$canje["sku"],
					"",
					$canje["description"],
					$canje["quantity"],
					$canje["price"],
					$canje["price"] * $this->pesos,
					$canje["address"],
					$canje["zip_code"],
					"",
					"",
					$canje["fullname"],
					$canje["phone"],
					$canje["email"],
					date("d/m/Y", $canje['order_date']),
					date("H:i:s", $canje['order_date']),
					$canje["other_sku"]
			));
		}

		return $this->csvExport('master-canjes.csv', $header, $records);

	}
}