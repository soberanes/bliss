<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mecanica\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class AcumulacionService implements ServiceManagerAwareInterface {

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
        $cuotasTable  = $this->getServiceManager()->get('cuotas_table');

        $user_id  = $dataLoadedObj->getUserId();
        $file_id  = $dataLoadedObj->getArchivoId();
        $month    = $dataLoadedObj->getMonth();
        $sucursal = $userProfileService->getUserInfoProfile($user_id)->getSucursal();

        $input_file = $modArchivosDao->getFile($file_id);
        $file_name  = $input_file->getFileName();

        $sheetData = $this->getFileData($file_name);

        $cuota_family = $cuotasTable->getCuota(1, $user_id, $month);
        $cuota = $cuota_family["quota"];



        // $this->_predump($cuota_family["quota"]);

    }

    /**
     * Process data sheet
     * 
     * @param Array $sheetData
     */
    public function acumulacion($sheetData, $cuota_family, $user_id, $month){
        $start  = 8;
        $finish = 1273 + 1;

        $salesmenCount = $this->getSalesmenCount($user_id);

        for ($i=$start; $i < $finish; $i++) { 
            
            for ($j=0; $j < $salesmenCount; $j++) { 
                
            }

        }
    }



    /**
     * Get salesman count
     * 
     * @param int $user_id
     * @return type Array
     */
    private function getSalesmenCount($user_id){
        
        
    }

    /**
     * Get loaded file sheet's data
     * 
     * @param string $inputFile
     * @return type Array
     */
    private function getFileData($inputFile){
        $inputFileLocation = '.'.$inputFile;
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileLocation);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        
        return $sheetData;
        
    }

    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</1pre>";
        die;
    }

}