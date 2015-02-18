<?php

namespace Mecanicas\Model\Entity;

use Mecanicas\Model\Entity\Generic\AbstractEntity;

class Puntos extends AbstractEntity implements PuntosInterface {

    /**
     * @var int
     */
    protected $puntosId;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var int
     */
    protected $facturacionId;

    /**
     * @var int
     */
    protected $productosHomologadosId;

    /**
     * @var float
     */
    protected $puntos;

    /**
     * @var int
     */
    protected $fechaCreacion;

    /**
     * @var int
     */
    protected $fechaActualizacion;

    /**
     * @var int
     */
    protected $estatus;

    /**
     * Get puntosId.
     *
     * @return int
     */
    public function getPuntosId() {
        return $this->puntosId;
    }

    /**
     * Set puntosId.
     *
     * @param int $puntosId
     * @return PuntosInterface
     */
    public function setPuntosId($puntosId) {
        $this->puntosId = (int) $puntosId;
        return $this;
    }

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set userId.
     *
     * @param int $userId
     * @return PuntosInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
        return $this;
    }

    /**
     * Get facturacionId.
     *
     * @return int
     */
    public function getFacturacionId() {
        return $this->facturacionId;
    }

    /**
     * Set facturacionId.
     *
     * @param int $facturacionId
     * @return PuntosInterface
     */
    public function setFacturacionId($facturacionId) {
        $this->facturacionId = (int) $facturacionId;
        return $this;
    }

    /**
     * Get productosHomologadosId.
     *
     * @return int
     */
    public function getProductosHomologadosId() {
        return $this->productosHomologadosId;
    }

    /**
     * Set productosHomologadosId.
     *
     * @param int $productosHomologadosId
     * @return PuntosInterface
     */
    public function setProductosHomologadosId($productosHomologadosId) {
        $this->productosHomologadosId = (int) $productosHomologadosId;
        return $this;
    }

    /**
     * Get puntos.
     *
     * @return float
     */
    public function getPuntos() {
        return $this->puntos;
    }

    /**
     * Set puntos.
     *
     * @param float $puntos
     * @return PuntosInterface
     */
    public function setPuntos($puntos) {
        $this->puntos = (float) $puntos;
        return $this;
    }

    /**
     * Get fechaCreacion.
     *
     * @return int
     */
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaCreacion.
     *
     * @param int $fechaCreacion
     * @return PuntosInterface
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = (int) $fechaCreacion;
        return $this;
    }

    /**
     * Get fechaActualizacion.
     *
     * @return int
     */
    public function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    /**
     * Set fechaActualizacion.
     *
     * @param int $fechaActualizacion
     * @return PuntosInterface
     */
    public function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = (int) $fechaActualizacion;
        return $this;
    }

    /**
     * Get estatus.
     *
     * @return int
     */
    public function getEstatus() {
        return $this->estatus;
    }

    /**
     * Set estatus.
     *
     * @param int $estatus
     * @return PuntosInterface
     */
    public function setEstatus($estatus) {
        $this->estatus = (int) $estatus;
        return $this;
    }

}
