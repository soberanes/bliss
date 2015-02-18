<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mecanicas\Service;

use Mecanicas\Service\AbstractService;
use Mecanicas\Model\Entity\Puntos;
use Facturacion\Model\Entity\Facturacion;
use Facturacion\Model\Entity\Conceptos;

class AbstractMethods extends AbstractService {

    protected $isCliente;

    function __construct() {
        $this->isCliente = false;
    }

    public function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }

    public function getMayorista() {
        $mayoristaDao = $this->get('Registro_Model_MayoristasDao');
        return $mayoristaDao->getByUser($this->getUserId());
    }

    public function getUsersGids() {
        $userGids = array();
        $facturas = $this->getFacturacionDao()->getFacturasGroupBy($this->getFolio());
        foreach ($facturas as $factura) {
            $archivosDao = $this->get('Uploader/Model/ModArchivosDao');
            $archivoInfo = $archivosDao->exists(null, $factura->getArchivoId(), 1);
            if ($archivoInfo) {
                $userDao = $this->get('zfcuser_user_mapper');
                $userObj = $userDao->findById($archivoInfo->getUserId());
                $userGids[] = $userObj->getGid();
            }
        }
        return $userGids;
    }

    public function isCliente($isCliente) {
        $this->isCliente = (int) $isCliente;
        return $this;
    }

    public function existeFactura($folio, $rfcEmisor){
        $facturacion = $this->getFacturacionDao();

        return $facturacion->exists($folio, $rfcEmisor);
    }

    public function saveFacturacion($estatus = 1){
        date_default_timezone_set('America/Mexico_City');
        $facturacion = $this->getFacturacionDao();

        $factObj = new Facturacion();
        $factObj->setArchivoId($this->getArchivoId())
                ->setUserId($this->getUserId())
                ->setNoFactura($this->getFolio())
                ->setFechaFactura($this->getFechaFactura())
                ->setRfcEmisor($this->getRfcEmisor())
                ->setRfcReceptor($this->getRfcReceptor())
                ->setCreationDate(time())
                ->setEstatus($estatus);
        return $facturacion->insert($factObj);
    }

    public function saveConceptos($facturacionId) {
        $conceptos = $this->getConceptos();
        $save = null;
        
        foreach ($conceptos as $concepto) {

            if(count($concepto) > 0){

                // Checking participant product
                $v_product = $this->searchProduct($this->getUserDistributor(), $concepto);

                if($v_product){
                    $save = $this->saveElement($concepto, $facturacionId, $v_product);
                    
                    if ($save <= 0) {
                        return $save;
                    }                    
                }
            }
        }
        return 1;
    }

    public function saveElement($concepto = array(), $facturacionId, $v_product) {
        $estatus = 0;

        $conceptObj = new Conceptos();
        $conceptObj->setFacturaId($facturacionId)
                   ->setSku($v_product->codigo_sap)
                   ->setDescription($concepto["descripcion"])
                   ->setImporte($concepto["importe"])
                   ->setCantidad($concepto["cantidad"])
                   ->setUnidad($concepto["unidad"])
                   ->setValorUnitario($concepto["valorUnitario"]);

        $conceptos_mapper = $this->getConceptosDao();
        $inserted = $conceptos_mapper->insert($conceptObj);
        return count($inserted);
        // Homologar SKU antes de guardar 
        // if (!empty($concepto)) {
        //     if (key_exists('noIdentificacion', $concepto)) {
        //         $sku = $concepto['noIdentificacion'];
        //         $factObj = $this->insertItem($concepto);
        //         $estatus = $this->asignaPuntos($factObj, $sku);
        //     } else {
        //         $estatus = -1;
        //     }
        // }
        // return $estatus;



    }

    public function asignaPuntos($factObj, $sku) {
        $pd = $this->getProductosHomologadosDao();
        if ($factObj !== null) {
            $puntObj = $pd->getPuntos($sku, $this->getMayoristaId(), $this->getUserGid());
            $this->savePuntos($factObj->getFacturacionId(), $puntObj, $factObj->getCantidad());
            return $factObj->getEstatus();
        }
    }

    public function savePuntos($facturacionId, $puntObj, $cantidad) {
        $puntosObj = new Puntos();
        $credits = $this->getCreditsDao();
        $puntosDao = $this->getPuntosDao();
        $puntos = 0;
        $homologacionId = 0;
        $userId = $this->getUserId();
        if ($puntObj !== false) {
            $homologacionId = (int) $puntObj->productos_homologados_id;
            $puntos = ((float) $puntObj->puntos) * $cantidad;
        }
        $puntosObj->setFacturacionId($facturacionId)
                ->setProductosHomologadosId($homologacionId)
                ->setPuntos($puntos)->setEstatus(1)
                ->setUserId($userId);
        $puntosDao->write($puntosObj);
        $credits->addCredit($userId, $puntos, 1);
        return true;
    }

    public function confirmaPuntos($conceptos, $estatus) {
        $factDao = $this->getFacturacionDao();
        foreach ($conceptos as $concepto) {
            $sku = $concepto->getSku();
            $this->asignaPuntos($concepto, $sku);
            $concepto->setEstatus($estatus);
            $factDao->actualiza($concepto);
        }
        return $estatus;
    }

    public function getUsuario($idPerfil) {
        $return = 0;
        switch ($idPerfil) {
            case 2:
                $return = $this->getDistribuidorId();
                break;
            case 4:
                $return = $this->getVendedorId();
                break;
            default :
                $return = $this->getClienteId();
                break;
        }
        return $return;
    }

    public function insertItem($concepto, $estatus = 1) {
        $factObj = new Facturacion();
        $factObj->setCantidad($concepto['cantidad'])
                ->setMayoristaId($this->getMayoristaId())
                ->setArchivoId($this->getArchivoId())
                ->setImporte($concepto['importe'])
                ->setSku($concepto['noIdentificacion'])
                ->setFechaFactura($this->getFechaFactura())
                ->setNoFactura($this->getFolio())
                ->setPeriodoId($this->getCurrentPeriod())
                ->setEstatus($estatus);
        return $this->getFacturacionDao()->insert($factObj);
    }

    public function isFechaValida() {
        date_default_timezone_set('America/Mexico_City');

        $current_month = date('m');
        // @remove
        $current_month = 11;
        $factura_month = date('m', $this->getFechaFactura());

        if($factura_month == $current_month){
            return true;
        }

        return false;
        
    }

}
