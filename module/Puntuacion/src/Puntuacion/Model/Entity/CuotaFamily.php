<?php

namespace Puntuacion\Model\Entity;

class CuotaFamily implements CuotaFamilyInterface {

	/**
     * @var int
     */
    protected $cuotaId;

	/**
     * @var int
     */
    protected $usuarioId;

    /**
     * @var int
     */
    protected $familiaId;


    /**
     * @var string
     */
    protected $familiaText;

    /**
     * @var float
     */
    protected $cuota;

	/**
     * @var float
     */
    protected $venta;
    
    /**
     * @var float
     */
    protected $puntos;

	/**
     * @var int
     */
    protected $mes;

    /**
     * Get cuotaId.
     *
     * @return int
     */
    public function getCuotaId() {
        return $this->cuotaId;
    }

    /**
     * Set cuotaId.
     *
     * @param int $cuotaId
     * @return ModArchivosInterface
     */
    public function setCuotaId($cuotaId) {
        $this->cuotaId = (int) $cuotaId;
        return $this;
    }

    /**
     * Get usuarioId.
     *
     * @return int
     */
    public function getUsuarioId() {
        return $this->usuarioId;
    }

    /**
     * Set usuarioId.
     *
     * @param int $usuarioId
     * @return ModArchivosInterface
     */
    public function setUsuarioId($usuarioId) {
        $this->usuarioId = (int) $usuarioId;
        return $this;
    }

    /**
     * Get familiaId.
     *
     * @return int
     */
    public function getFamiliaId() {
        return $this->familiaId;
    }

    /**
     * Set familiaId.
     *
     * @param int $familiaId
     * @return ModArchivosInterface
     */
    public function setFamiliaId($familiaId) {
        $this->familiaId = (int) $familiaId;
        return $this;
    }

    /**
     * Get familiaText.
     *
     * @return string
     */
    public function getFamiliaText() {
        return $this->familiaText;
    }

    /**
     * Set familiaText.
     *
     * @param string $familiaText
     * @return ModArchivosInterface
     */
    public function setFamiliaText($familiaText) {
        $this->familiaText = (string) $familiaText;
        return $this;
    }

    /**
     * Get cuota.
     *
     * @return float
     */
    public function getCuota() {
        return $this->cuota;
    }

    /**
     * Set cuota.
     *
     * @param float $cuota
     * @return ModArchivosInterface
     */
    public function setCuota($cuota) {
        $this->cuota = (float) $cuota;
        return $this;
    }

    /**
     * Get venta.
     *
     * @return float
     */
    public function getVenta() {
        return $this->venta;
    }

    /**
     * Set venta.
     *
     * @param float $venta
     * @return ModArchivosInterface
     */
    public function setVenta($venta) {
        $this->venta = (float) $venta;
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
     * @return ModArchivosInterface
     */
    public function setPuntos($puntos) {
        $this->puntos = (float) $puntos;
        return $this;
    }

    /**
     * Get mes.
     *
     * @return int
     */
    public function getMes() {
        return $this->mes;
    }

    /**
     * Set mes.
     *
     * @param int $mes
     * @return ModArchivosInterface
     */
    public function setMes($mes) {
        $this->mes = (int) $mes;
        return $this;
    }

}