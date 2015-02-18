<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mecanicas\Service;

use Mecanicas\Service\AbstractMethods;

class Acumulacion extends AbstractMethods {

    public function procesa($archivoId, $filename, $gerenteId) {
        date_default_timezone_set('America/Mexico_City');
        $this->init($archivoId, $filename);

        if (!$this->isFechaValida()) {
            return -4;
        }

        $exists = $this->existeFactura($this->getFolio(), $this->getRfcEmisor());
        
        if($exists){
            return null;
        }
        
        // guardar factura
        $facturacion_id = $this->saveFacturacion();
        // guardar conceptos
        return $this->saveConceptos($facturacion_id->getFacturacionId());
    }

    public function _predump($arg){
    	echo "<pre>";
    	var_dump($arg);
    	echo "</pre>";
    	die;
    }


}