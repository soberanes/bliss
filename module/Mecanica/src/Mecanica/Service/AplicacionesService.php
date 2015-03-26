<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mecanica\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Mecanica\Service\AbstractMethods;

class AplicacionesService extends AbstractMethods implements ServiceManagerAwareInterface {
	/**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var adapter
     */
    protected $adapter;

    /**
     * Set the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Uploader\Service\Acumulacion
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Get the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Mecanica\Service\Acumulacion
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }
    
    /**
     * Process data from loaded file
     * 
     * @param object $dataLoadedObj        
     * @return type booleanpp
     */
    public function processFile($data, $filename){
        date_default_timezone_set('America/Mexico_City');

        $userService        = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $userProfileService = $this->getServiceManager()->get('user_profile_service');

        $user_id = $data['user'];
        $month   = $data['month'];
        $sucursal = $userProfileService->getUserInfoProfile($user_id)->getSucursal();

        $sheetData = $this->getFileData($filename);

        /* PENDIENTE: ASIGNAR PUNTOS POR PRODUCTO APLICACIÓN */
        $this->acumulacionAplicaciones($sheetData, $user_id, $month);
    }


    /**
     * Process data sheet
     * 
     * @param Array $sheetData
     */
    public function acumulacionAplicaciones($sheetData, $user_id, $month){
        $userProfileService = $this->getServiceManager()->get('user_profile_service');

        $start  = 8 + 1;
        $apps_count = $this->getAppsCount();
        $finish = $start + $apps_count;

        $x = 'G'; //inician vendedores
        $col_vendedores = array();
        $ventas_data = array();

        //Obteniendo vendedores
        $vendedores = $userProfileService->getUsersByParent($user_id);
        $limit = count($vendedores);

        //ciclo por vendedores
        for($j=0;$j<$limit;$j++) {  

            // obtener el usuario en la columna G
            $vendedor = $sheetData[8][$x];
            // $vendedor_data = array(
            //     "vendedor_id" => $userProfileService->getUserByName($vendedor),
            //     "vendedor"    => $vendedor
            // );

            array_push($col_vendedores, $vendedor);
            $x++;
        }

        $x = 'G'; // reset $x
        $ventas_data = array();
        $venta_f     = array();

        // ciclo por fila
        for ($i = $start; $i < $finish; $i++) {
            $producto = $sheetData[$i]['B'];

            // ciclo por columna
            for($j = 0; $j < count($col_vendedores); $j++){

                // obtener la cuota por la $familia del $producto
                $product_data  = $this->getProduct($producto);

                $familia = $product_data["familia_id"];

                $user = $this->getUserByFullname($col_vendedores[$j]);

                $user_id       = $user->getUserId();
                $venta         = $sheetData[$i][$x];
                
                $cuota_usuario = $this->getCuota($user->getUserId(), $month, $familia);

                $venta_user_f  = @$ventas_data[$familia][$user_id]["suma_venta"];
                
                $ventas_data[$familia][$user_id]["suma_venta"] = $venta_user_f + $venta;
                $ventas_data[$familia][$user_id]["cuota_id"]   = $cuota_usuario["cuota_id"];
                $ventas_data[$familia][$user_id]["cuota"]      = $cuota_usuario["cuota"];

                $x++;
                
            }
       
            $x = 'G';
           
             
        }

    }

}