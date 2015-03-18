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

class AcumulacionService extends AbstractMethods implements ServiceManagerAwareInterface {

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
     * @return type boolean
     */
    public function process($dataLoadedObj){
        
        $dataLoadedDao      = $this->getServiceManager()->get('Uploader/Model/DataLoadedDao');
        $modArchivosDao     =  $this->getServiceManager()->get('Uploader/Model/ModArchivosDao');
        $userService        = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $userProfileService = $this->getServiceManager()->get('user_profile_service');
        
        $user_id  = $dataLoadedObj->getUserId();
        $file_id  = $dataLoadedObj->getArchivoId();
        $month    = $dataLoadedObj->getMonth();
        $sucursal = $userProfileService->getUserInfoProfile($user_id)->getSucursal();

        $input_file = $modArchivosDao->getFile($file_id);
        $file_name  = $input_file->getFileName();

        $sheetData = $this->getFileData($file_name);

        $this->acumulacionVendedores($sheetData, $user_id, $month);
        $this->acumulacionEncargados($user_id, $file_id, $month);

        // otorgar crédito
        $success = $this->setCredit($user_id, $month);

        return $success;

    }

    public function acumulacionEncargados($user_id, $file_id, $month){
        date_default_timezone_set('America/Mexico_City');
        $puntos_plus = $this->getPlus($user_id);
        
        $data = array(
            "user_id"  => $user_id,
            "file_id"  => $file_id,
            "mes"      => $month,
            "plus"     => $puntos_plus,
            "puntos"   => 0,
            "reg_date" => time(),
            "status"   => 1
        );

        return $this->setPuntosEncargado($data);

    }

    /**
     * Process data sheet
     * 
     * @param Array $sheetData
     */
    public function acumulacionVendedores($sheetData, $user_id, $month){
        $userProfileService = $this->getServiceManager()->get('user_profile_service');
        
        $start  = 8 + 1;
        $product_count = $this->getProductCount();
        $apps_count = $this->getAppsCount();
        $finish = $start + $product_count;
        
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
                $ventas_data[$familia][$user_id]["cuota"] = $cuota_usuario["cuota"];

                $x++;
                
            }
       
            $x = 'G';
                //var_dump($sheetData[$i][$j]);
                // die;
            
        }

        // asignación de puntos - mecánica
        $this->aplicarMecanica($ventas_data, $month);

    }

    public function aplicarMecanica($acumulado_ventas, $month){
        //ciclo por cada familia
        date_default_timezone_set('America/Mexico_City');

        foreach ($acumulado_ventas as $key => $value) {

            $familia = $key;

            //ciclo por cada usuario
            foreach ($value as $k => $data) {
                
                $user = $k;


                $venta   = $data["suma_venta"];
                $cuota   = $data["cuota"];
            
                var_dump($user);
                var_dump($data); 
                die;
            }

            //echo "usuario " . $user . "\n";


            $media_ventas = ($venta * 100) / $cuota;
            $puntos = 0;
            
            if($media_ventas >= 80 && $media_ventas < 100){
                $puntos = 40;
            }elseif($media_ventas >= 100 && $media_ventas < 120){
                $puntos = 50;
            }elseif($media_ventas >= 120){
                $puntos = 60;
            }else{ // menor a ochenta
                $puntos = 0;
            }

            //revisar si todos los vendedores cubrieron la cuota!! 
                // sumar todas las medias y compararlas con la suma de las cuotas. $this->getCuotasByParent()

            //echo "venta: " . $venta . " cuota: " . $cuota . " media: " . $media_ventas . " puntos: " . $puntos . "\n";
            $puntos_data = array(
                "user_id"  => $user,
                "mes"      => $month,
                "cuota"    => $cuota,
                "venta"    => $venta,
                "puntos"   => $puntos,
                "reg_date" => time(),
                "status"   => 1
            );

            $this->setPuntos($puntos_data);

        }
    }


}