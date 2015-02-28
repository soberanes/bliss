<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Uploader\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\Container;
use Zend\Validator\File\Size;
use Uploader\Model\Entity\ModArchivos;
use Uploader\Model\Entity\DataLoaded;

class UploadFileService implements ServiceManagerAwareInterface {

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Set the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Uploader\Service\ProcessFile
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Función que permite cargar un archivo y guardarlo en la carpeta data
     * @param \Zend\Http\Request $request
     * @return mixed
     */
    public function uploadFile($request) {
        date_default_timezone_set('America/Mexico_City');
        $form = $this->getForm();
        $container = new Container('partialContainer');
        $tempFile = $container->partialTempFile;
        $file = null;

        $current_month = date('m');

        if ($request->isPost()) {
            // POST Request: Process form
            $data = array_merge_recursive(
                    $request->getPost()->toArray(), $request->getFiles()->toArray()
            );

            $user_id = $data['user'];

            if (!key_exists('name', $data)) {
                $data['name'] = $data['archivo']['name'];
            }
            
            $form->setData($data);
            
                $extension = new \Zend\Validator\File\Extension(array('extension' => array('xls')));
                $adapter = new \Zend\File\Transfer\Adapter\Http(); 

                $adapter->setValidators(array($extension), $data['archivo']);
                // echo "<pre>";var_dump($data['archivo']["name"]);die;
                if ($adapter->isValid()) {
                    // If we did not get a new file upload this time around, use the temp file
                    
                    //$data = $form->getData();
                    $filename = $data['archivo']['tmp_name'];
                    $ext = end((explode(".", $data['archivo']['name'])));

                    $adapter->setDestination('./data/files/uploads/'.$current_month.'/');

                    $adapter->addFilter(
                        'Rename', array(
                            "target"    => "./data/files/uploads/".$current_month.'/formato_usuario_'.$user_id.'.'.$ext,
                            "overwrite" => true,
                            "randomize" => false
                        )
                    );

                    $adapter->receive();
                    $file_name = $adapter->getFileName();
                    
                    $data["name"] = ltrim($file_name, '.'); //removing point >> ./data
                                        
                    $file = $this->_saveEntity($data, $current_month);
                    if (isset($data['archivo']['error']) && $data['archivo']['error'] !== UPLOAD_ERR_OK) {
                        $data['archivo'] = $tempFile;
                    }
                }
            
        } else {
            // GET Request: Clear previous temp file from session
            unset($container->partialTempFile);
            $tempFile = null;
        }
        return array('error' => $tempFile, 'file' => $file);
    }

    /**
     * Método para obtener el formulario de carga
     * 
     * @return Uploader\Service\ProcessFile
     */
    public function getForm() {
        return $this->serviceManager->get('uploader_form');
    }

    private function _saveEntity($data, $month) {
        $userInfo = $this->getBasicInfoService();
        $archivosDao = $this->getServiceManager()->get('Uploader/Model/ModArchivosDao');
        $archivoObj = new ModArchivos();
        $userId = $userInfo['id'];
        $archivoObj->setFilename($data['name'])
                   ->setUserId($userId)
                   ->setPeriodM($month)
                   ->setStatus(1)
                   ->setUploadDate(time());

        //check for archivo existence
        $exists = $archivosDao->exists($userId, $month);
        if($exists){
            $where = array(
                'user_id' => $userId,
                'period_m' => $month
            );

            $archivoObj->setArchivoId($exists->getArchivoId());
            return $archivosDao->update($archivoObj, $where);
        }
        
        return $archivosDao->insert($archivoObj);
    }

    public function getBasicInfoService() {
        $core_service_cmf_user = $this->getServiceManager()->get('core_service_cmf_user');
        return $core_service_cmf_user->getUser()->getBasicInfo();
    }

    public function checkLoad($user, $archivoId, $status){
        date_default_timezone_set('America/Mexico_City');
        $month = date('m');

        $dataloadedDao = $this->getServiceManager()->get('Uploader/Model/DataLoadedDao');
        $dataloadedObj = new DataLoaded();

        $dataloadedObj->setUserId($user)
                      ->setArchivoId($archivoId)
                      ->setMonth($month)
                      ->setProcessDate(time())
                      ->setStatus($status);
        return $dataloadedDao->update($dataloadedObj);
    }

}
