<?php

namespace Uploader\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class UploaderController extends AbstractActionController {

    public function indexAction() {
        $form = $this->getServiceLocator()->get('formFileUploader');
        return new ViewModel(array('form' => $form));
    }

    public function uploadAction() {
        $fileService = $this->getServiceLocator()->get('uploader_file_service');
        $request = $this->getRequest();
        $error = null;
        if ($request->isPost()) {
            $data = $fileService->uploadFile($request);
            if ($data['error'] === null) {
                $error = $this->forward()->dispatch('Uploader\Controller/uploader', array(
                    'action' => 'process',
                    'content' => $data['filename']
                ));
            }
        }
        return new ViewModel(array('errores' => $error));
    }

    public function processAction() {
        var_dump($this->params('content'));
        $fileProcesing = $this->getServiceLocator()->get('process_file_service');
//        $errores = $fileProcesing->insertFile($fileName, $mapper, $modelo);
//        return new ViewModel(array('errores' => $errores));
        return 'askjdkjadbkasd';
    }

}
