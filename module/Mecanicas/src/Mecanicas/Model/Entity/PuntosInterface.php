<?php

namespace Mecanicas\Model\Entity;

interface PuntosInterface {

    /**
     * Get puntosId.
     *
     * @return int
     */
    public function getPuntosId();

    /**
     * Set puntosId.
     *
     * @param int $puntosId
     * @return PuntosInterface
     */
    public function setPuntosId($puntosId);

    /**
     * Get userId.
     *
     * @return int
     */
    public function getUserId();

    /**
     * Set userId.
     *
     * @param int $userId
     * @return PuntosInterface
     */
    public function setUserId($userId);

    /**
     * Get facturacionId.
     *
     * @return int
     */
    public function getFacturacionId();

    /**
     * Set facturacionId.
     *
     * @param int $facturacionId
     * @return PuntosInterface
     */
    public function setFacturacionId($facturacionId);

    /**
     * Get productosHomologadosId.
     *
     * @return int
     */
    public function getProductosHomologadosId();

    /**
     * Set productosHomologadosId.
     *
     * @param int $productosHomologadosId
     * @return PuntosInterface
     */
    public function setProductosHomologadosId($productosHomologadosId);

    /**
     * Get puntos.
     *
     * @return float
     */
    public function getPuntos();

    /**
     * Set puntos.
     *
     * @param float $puntos
     * @return PuntosInterface
     */
    public function setPuntos($puntos);

    /**
     * Get fechaCreacion.
     *
     * @return int
     */
    public function getFechaCreacion();

    /**
     * Set fechaCreacion.
     *
     * @param int $fechaCreacion
     * @return PuntosInterface
     */
    public function setFechaCreacion($fechaCreacion);

    /**
     * Get fechaActualizacion.
     *
     * @return int
     */
    public function getFechaActualizacion();

    /**
     * Set fechaActualizacion.
     *
     * @param int $fechaActualizacion
     * @return PuntosInterface
     */
    public function setFechaActualizacion($fechaActualizacion);

    /**
     * Get estatus.
     *
     * @return int
     */
    public function getEstatus();

    /**
     * Set estatus.
     *
     * @param int $estatus
     * @return PuntosInterface
     */
    public function setEstatus($estatus);
}
