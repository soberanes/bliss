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
        $form = $this->getForm();
        $container = new Container('partialContainer');
        $tempFile = $container->partialTempFile;
        $file = null;
        if ($request->isPost()) {
            // POST Request: Process form
            $data = array_merge_recursive(
                    $request->getPost()->toArray(), $request->getFiles()->toArray()
            );

            if (!key_exists('name', $data)) {
                $data['name'] = $data['archivo']['name'];
            }

            $form->setData($data);
            
            if ($form->isValid()) {
                $extension = new \Zend\Validator\File\Extension(array('extension' => array('xlsx')));
                $adapter = new \Zend\File\Transfer\Adapter\Http(); 

                $adapter->setValidators(array($extension), $data['archivo']);
                // echo "<pre>";var_dump($data['archivo']["name"]);die;
                if ($adapter->isValid()) {
                    // If we did not get a new file upload this time around, use the temp file
                    
                    //$data = $form->getData();
                    $filename = $data['archivo']['tmp_name'];
                    
                    $adapter->setDestination('./data/files/uploads/');

                    $adapter->addFilter(
                        'Rename', array(
                            "target"    => "./data/files/uploads/".$data['archivo']["name"],
                            "randomize" => true
                        )
                    );

                    $adapter->receive();
                    $file_name = $adapter->getFileName();
                    


                    $data["name"] = ltrim($file_name, '.'); //removing point >> ./data
                                        
                    $file = $this->_saveEntity($data);
                    if (isset($data['archivo']['error']) && $data['archivo']['error'] !== UPLOAD_ERR_OK) {
                        $data['archivo'] = $tempFile;
                    }
                }
            } else {
                // Extend the session
                $container->setExpirationHops(1, 'partialTempFile');
                // Form was not valid, but the file input might be...
                // Save file to a temporary file if valid.
                // $data = $form->getData();
                $tempFile = $form->get('archivo')->getMessages();
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

    private function _saveEntity($data) {
        $userInfo = $this->getBasicInfoService();
        $archivosDao = $this->getServiceManager()->get('Uploader/Model/ModArchivosDao');
        $archivoObj = new ModArchivos();
        $userId = $userInfo['id'];
        $archivoObj->setFilename($data['name'])
                   ->setUserId($userId)
                   ->setStatus(1)
                   ->setCreationDate(time());
        return $archivosDao->insert($archivoObj);
    }

    public function getBasicInfoService() {
        $core_service_cmf_user = $this->getServiceManager()->get('core_service_cmf_user');
        return $core_service_cmf_user->getUser()->getBasicInfo();
    }

    public function checkLoad($user, $status){
        date_default_timezone_set('America/Mexico_City');
        $month = date('m');

        $dataloadedDao = $this->getServiceManager()->get('Uploader/Model/DataLoadedDao');
        $dataloadedObj = new DataLoaded();

        $dataloadedObj->setUserId($user)
                      ->setMonth($month)
                      ->setProcessDate(time())
                      ->setStatus($status);
        return $dataloadedDao->update($dataloadedObj);
    }

}
