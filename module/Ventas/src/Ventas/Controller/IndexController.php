<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Ventas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController{
    
    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }
    
    public function indexAction() {
        $form = $this->get('ventas_uploader_form');
        $gerente = $this->getGerente();

        if ($gerente) {
            $gerente_id = $gerente->getUserId();
        }

        return new ViewModel(array('form' => $form));
    }

	public function uploadAction() {
        $fileService = $this->get('uploader_service');
        $request = $this->getRequest();

        $error = -1;
        $detalle = null;

        if ($request->isPost()) {

            $data = $fileService->uploadFile($request);

            if ($data['error'] === null) {

                $fileName = $data['file']->getFilename();
                $archivoId = $data['file']->getArchivoId();
                $gerente = $this->getGerente();

                $fileService->checkLoad($gerente->getUserId(), 1);
                $error = 1;
                $detalle = "El archivo se ha guardado con éxito. En breve será revisado para la asignación de puntos.";
            }
        }
        return new JsonModel(array('data' => array('err' => $error, 'detalle' => $detalle)));
        
    }

    private function canUpload() {
        $factPeriods = $this->get('facturacion_periods');
        foreach ($factPeriods as $periodo) {
            $time = time();
            if ($time >= $periodo['start_upload'] && $time <= $periodo['end_upload']) {
                return true;
            }
        }
        return false;
    }

    private function procesa($archivosId, $fileName, $gerenteId) {
        $service = $this->get('mecanica_acumulacion');
        return $service->procesa($archivosId, $fileName, $gerenteId);
    }

    private function getGid() {
        $info = $this->getBasicInfo();
        return (int) $info['gid'];
    }

    private function getUserId() {
        $info = $this->getBasicInfo();
        return (int) $info['id'];
    }

    private function getBasicInfo() {
        $core_service_cmf_user = $this->get('core_service_cmf_user');
        return $core_service_cmf_user->getUser()->getBasicInfo();
    }

    private function get($param) {
        return $this->getServiceLocator()->get($param);
    }

    public function getGerente() {
        $mayoristaDao = $this->get('Cshelperzfcuser\Model\Mapper\UserInfoProfile');
        return $mayoristaDao->getUserInfoProfile($this->getUserId());
    }

}
