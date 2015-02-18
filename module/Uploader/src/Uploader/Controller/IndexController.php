<?php

namespace Uploader\Controller;

use Zend\Json\Json as Json;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $service = $this->_getService();
        $userInfoDao = $this->_getService('Cshelperzfcuser\Model\Mapper\UserInfoDao');
        $info = $service->getUserId();
        if (!$userInfoDao->exists($info['id'])) {
            $forms = $service->getForms();
            return new ViewModel($forms);
        }
        return $this->redirect()->toRoute('registro/uploader');
    }

    public function getinfoAction() {
        $request = $this->getRequest();
        $municipios = array();
        if ($request->isXmlHttpRequest()) {
            $service = $this->_getService();
            $array = Json::decode($request->getContent(), Json::TYPE_ARRAY);
            $municipios = $service->getInfo($array['cp']);
        }
        return new JsonModel(array('data' => $municipios));
    }

    public function saveiuAction() {
        $service = $this->_getService();
        $request = $this->getRequest();
        if ($request->isXmlHttpRequest()) {
            $array = Json::decode($request->getContent(), Json::TYPE_ARRAY);
            $data = $service->saveUserInfo($array);
        }
        return new JsonModel(array('data' => array('procesado' => $data)));
    }

    private function _getService($name = 'registro_service') {
        return $this->getServiceLocator()->get($name);
    }

}
