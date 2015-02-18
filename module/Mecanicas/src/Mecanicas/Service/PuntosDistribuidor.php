<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mecanicas\Service;

use Mecanicas\Service\AbstractMethods;

class PuntosDistribuidor extends AbstractMethods {

    protected $facturacionDao;

    public function procesa($archivoId, $filename) {
        $this->init($archivoId, $filename);
        if (!$this->isFechaValida()) {
            return -4;
        }
        $mayorista = $this->getMayorista();
        if ($this->getRfcEmisor() === $mayorista->getRfc()) {
            $userGids = $this->getUsersGids();
            if (!in_array($this->getUserGid(), $userGids)) {
                $this->setMayoristaId($mayorista->getMayoristaId());
                return $this->saveConceptos();
            }
            return null;
        }
        return -2;
    }

}
