<?php

namespace Mecanicas\Model\Entity;

interface ProductosPuntuacionInterface {

    /**
     * Get productosPuntuacionId.
     *
     * @return int
     */
    public function getProductosPuntuacionId();

    /**
     * Set productosPuntuacionId.
     *
     * @param int $productosPuntuacionId
     * @return ProductosPuntuacionInterface
     */
    public function setProductosPuntuacionId($productosPuntuacionId);

    /**
     * Get productoGlobalId.
     *
     * @return int
     */
    public function getProductoGlobalId();

    /**
     * Set productoGlobalId.
     *
     * @param int $productoGlobalId
     * @return ProductosPuntuacionInterface
     */
    public function setProductoGlobalId($productoGlobalId);

    /**
     * Get perfilId.
     *
     * @return int
     */
    public function getPerfilId();

    /**
     * Set perfilId.
     *
     * @param int $perfilId
     * @return ProductosPuntuacionInterface
     */
    public function setPerfilId($perfilId);

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
     * @return ProductosPuntuacionInterface
     */
    public function setPuntos($puntos);

    /**
     * Get inversion.
     *
     * @return float
     */
    public function getInversion();

    /**
     * Set inversion.
     *
     * @param float $inversion
     * @return ProductosPuntuacionInterface
     */
    public function setInversion($inversion);

    /**
     * Get porcentaje.
     *
     * @return float
     */
    public function getPorcentaje();

    /**
     * Set porcentaje.
     *
     * @param float $porcentaje
     * @return ProductosPuntuacionInterface
     */
    public function setPorcentaje($porcentaje);

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
     * @return ProductosPuntuacionInterface
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
     * @return ProductosPuntuacionInterface
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
     * @return ProductosPuntuacionInterface
     */
    public function setEstatus($estatus);
}
