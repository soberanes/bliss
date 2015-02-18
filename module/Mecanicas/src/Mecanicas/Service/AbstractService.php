<?php

namespace Mecanicas\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;

class AbstractService extends EventProvider implements ServiceManagerAwareInterface {

    protected $folio;
    protected $archivoId;
    protected $rfcEmisor;
    protected $conceptos;
    protected $puntosDao;
    protected $creditsDao;
    protected $userInfoDao;
    protected $rfcReceptor;
    protected $mayoristaId;
    protected $fechaFactura;
    protected $asignacionDao;
    protected $facturacionDao;
    protected $conceptosDao;
    protected $serviceManager;
    protected $productosDistribuidorDao;

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function init($archivoId, $filename) {
        date_default_timezone_set('America/Mexico_City');
        $data = $this->xml2array($filename);
        if (!empty($data)) {
            $key = 'cfdi:';
            $comprobante = isset($data[$key . 'Comprobante']) ? $data[$key . 'Comprobante'] : $data['Comprobante'];
            $comprobanteAtr = isset($data[$key . 'Comprobante_attr']) ? $data[$key . 'Comprobante_attr'] : $data['Comprobante_attr'];
            $rfcEmisor = isset($comprobante[$key . 'Emisor_attr']) ? $comprobante[$key . 'Emisor_attr']['rfc'] : $comprobante['Emisor_attr']['rfc'];
            $rfcReceptor = isset($comprobante[$key . 'Receptor_attr']) ? $comprobante[$key . 'Receptor_attr']['rfc'] : $comprobante['Receptor_attr']['rfc'];
            $conceptos = isset($comprobante[$key . 'Conceptos']) ? $comprobante[$key . 'Conceptos'] : $comprobante['Conceptos'];
            if (isset($conceptos[$key . 'Concepto_attr']) || isset($conceptos['Concepto_attr'])) {
                $conceptos = isset($conceptos[$key . 'Concepto_attr']) ? $conceptos[$key . 'Concepto_attr'] : $conceptos['Concepto_attr'];
            } else {
                $conceptos = isset($conceptos[$key . 'Concepto']) ? $conceptos[$key . 'Concepto'] : $conceptos['Concepto'];
            }
            $this->setRfcReceptor($rfcReceptor);
            $this->setRfcEmisor($rfcEmisor);
            $this->setConceptos($conceptos);
            $this->setFolio($comprobanteAtr['folio']);
            $this->setFechaFactura(strtotime($comprobanteAtr['fecha']));
            $this->setArchivoId($archivoId);
        }
    }

    public function getUserId() {
        $array = $this->getBasicInfo();
        return $array['id'];
    }

    public function getUserGid() {
        $array = $this->getBasicInfo();
        return $array['gid'];
    }

    public function getUserDistributor() {
        $array = $this->getBasicInfo();
        return $array['parent'];
    }

    public function getBasicInfo() {
        $core_service_cmf_user = $this->get('core_service_cmf_user');
        return $core_service_cmf_user->getUser()->getBasicInfo();
    }

    public function getUserIdByRfc($rfc) {
        $userDao = $this->getUserInfoDao();
        $user = $userDao->getByRfc($rfc);
        if ($user !== false) {
            return $user->getUserId();
        }
        return null;
    }

    public function getFacturacionDao() {
        if ($this->facturacionDao === null) {
            $this->facturacionDao = $this->get('Facturacion/Model/FacturacioDao');
        }
        return $this->facturacionDao;
    }

    public function getConceptosDao() {
        if ($this->conceptosDao === null) {
            $this->conceptosDao = $this->get('Facturacion/Model/ConceptosDao');
        }
        return $this->conceptosDao;
    }

    public function getProductosHomologadosDao() {
        if ($this->productosDistribuidorDao === null) {
            $this->productosDistribuidorDao = $this->get('Mecanicas_Model_ProductosHomologadosTable');
        }
        return $this->productosDistribuidorDao;
    }

    public function getPuntosDao() {
        if ($this->puntosDao === null) {
            $this->puntosDao = $this->get('Mecanicas_Model_PuntosTable');
        }
        return $this->puntosDao;
    }

    public function getCreditsDao() {
        if ($this->creditsDao === null) {
            $creditsDao = $this->get('core_service_cmf_credits');
            $this->creditsDao = $creditsDao->getCredits();
        }
        return $this->creditsDao;
    }

    public function getUserInfoDao() {
        if ($this->userInfoDao === null) {
            $this->userInfoDao = $this->get('Cshelperzfcuser\Model\Mapper\UserInfoDao');
        }
        return $this->userInfoDao;
    }

    public function getAsignacionDao() {
        if ($this->asignacionDao === null) {
            $this->asignacionDao = $this->get('Cshelperzfcuser\Model\Mapper\AsignacionDao');
        }
        return $this->asignacionDao;
    }

    public function get($param) {
        return $this->getServiceManager()->get($param);
    }

    private function xml2array($filename) {
        $parser = $this->get('facturacion_xml_service');
        return $parser->parser(file_get_contents($filename));
    }

    public function getCurrentPeriod() {
        $CreditsperiodsTable = $this->getServiceManager()
                ->get('Cscore\Model\CreditsperiodsTable');
        return $CreditsperiodsTable->getIdPeriodNow();
    }

    public function searchProduct($distribuidor, $concepto){
        $productTable = $this->getServiceManager()
                    ->get('Mecanicas_Model_Products');
        return $productTable->searchProduct($distribuidor, $concepto);
    }

    public function getConceptos() {
        return $this->conceptos;
    }

    public function getFolio() {
        return $this->folio;
    }

    public function getFechaFactura() {
        return $this->fechaFactura;
    }

    public function getArchivoId() {
        return $this->archivoId;
    }

    public function getRfcEmisor() {
        return $this->rfcEmisor;
    }

    public function getRfcReceptor() {
        return $this->rfcReceptor;
    }

    public function getMayoristaId() {
        return $this->mayoristaId;
    }

    public function setConceptos($conceptos) {
        $this->conceptos = $conceptos;
        return $this;
    }

    public function setFolio($folio) {
        $this->folio = $folio;
        return $this;
    }

    public function setFechaFactura($fechaFactura) {
        $this->fechaFactura = $fechaFactura;
        return $this;
    }

    public function setArchivoId($archivoId) {
        $this->archivoId = $archivoId;
        return $this;
    }

    public function setRfcEmisor($rfcEmisor) {
        $this->rfcEmisor = $rfcEmisor;
        return $this;
    }

    public function setRfcReceptor($rfcReceptor) {
        $this->rfcReceptor = $rfcReceptor;
        return $this;
    }

    public function setMayoristaId($mayoristaId) {
        $this->mayoristaId = (int) $mayoristaId;
        return $this;
    }

}
