<?php

namespace Puntuacion\Model\Entity;

class Puntuacion implements PuntuacionInterface {

	/**
     * @var int
     */
    protected $puntuacionId;

	/**
     * @var int
     */
    protected $userId;

	/**
     * @var int
     */
    protected $mes;

	/**
     * @var int
     */
    protected $cuota;

	/**
     * @var int
     */
    protected $venta;

	/**
     * @var int
     */
    protected $puntos;
	
	/**
     * @var int
     */
    protected $regDate;

	/**
     * @var int
     */
    protected $status;

    /**
     * Get puntuacionId.
     *
     * @return int
     */
    public function getPuntuacionId() {
        return $this->puntuacionId;
    }

    /**
     * Set puntuacionId.
     *
     * @param int $puntuacionId
     * @return ModArchivosInterface
     */
    public function setPuntuacionId($puntuacionId) {
        $this->puntuacionId = (int) $puntuacionId;
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
     * @return ModArchivosInterface
     */
    public function setUserId($userId) {
        $this->userId = (int) $userId;
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

    /**
     * Get cuota.
     *
     * @return int
     */
    public function getCuota() {
        return $this->cuota;
    }

    /**
     * Set cuota.
     *
     * @param int $cuota
     * @return ModArchivosInterface
     */
    public function setCuota($cuota) {
        $this->cuota = (int) $cuota;
        return $this;
    }

    /**
     * Get ventas.
     *
     * @return int
     */
    public function getVenta() {
        return $this->venta;
    }

    /**
     * Set ventas.
     *
     * @param int $ventas
     * @return ModArchivosInterface
     */
    public function setVenta($venta) {
        $this->venta = (int) $venta;
        return $this;
    }

    /**
     * Get puntos.
     *
     * @return int
     */
    public function getPuntos() {
        return $this->puntos;
    }

    /**
     * Set puntos.
     *
     * @param int $puntos
     * @return ModArchivosInterface
     */
    public function setPuntos($puntos) {
        $this->puntos = (int) $puntos;
        return $this;
    }
	
    /**
     * Get regDate.
     *
     * @return int
     */
    public function getRegDate() {
        return $this->regDate;
    }

    /**
     * Set regDate.
     *
     * @param int $regDate
     * @return ModArchivosInterface
     */
    public function setRegDate($regDate) {
        $this->regDate = (int) $regDate;
        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set status.
     *
     * @param int $status
     * @return ModArchivosInterface
     */
    public function setStatus($status) {
        $this->status = (int) $status;
        return $this;
    }
    
}
