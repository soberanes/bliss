<?php

namespace Mecanicas\Model\Entity;

class ProductosPuntuacion implements ProductosPuntuacionInterface {

    /**
     * @var int
     */
    protected $productosPuntuacionId;

    /**
     * @var int
     */
    protected $productoGlobalId;

    /**
     * @var int
     */
    protected $perfilId;

    /**
     * @var float
     */
    protected $puntos;

    /**
     * @var float
     */
    protected $inversion;

    /**
     * @var float
     */
    protected $porcentaje;

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
     * Get productosPuntuacionId.
     *
     * @return int
     */
    public function getProductosPuntuacionId() {
        return $this->productosPuntuacionId;
    }

    /**
     * Set productosPuntuacionId.
     *
     * @param int $productosPuntuacionId
     * @return ProductosPuntuacionInterface
     */
    public function setProductosPuntuacionId($productosPuntuacionId) {
        $this->productosPuntuacionId = (int) $productosPuntuacionId;
        return $this;
    }

    /**
     * Get productoGlobalId.
     *
     * @return int
     */
    public function getProductoGlobalId() {
        return $this->productoGlobalId;
    }

    /**
     * Set productoGlobalId.
     *
     * @param int $productoGlobalId
     * @return ProductosPuntuacionInterface
     */
    public function setProductoGlobalId($productoGlobalId) {
        $this->productoGlobalId = (int) $productoGlobalId;
        return $this;
    }

    /**
     * Get perfilId.
     *
     * @return int
     */
    public function getPerfilId() {
        return $this->perfilId;
    }

    /**
     * Set perfilId.
     *
     * @param int $perfilId
     * @return ProductosPuntuacionInterface
     */
    public function setPerfilId($perfilId) {
        $this->perfilId = (int) $perfilId;
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
     * @return ProductosPuntuacionInterface
     */
    public function setPuntos($puntos) {
        $this->puntos = (float) $puntos;
        return $this;
    }

    /**
     * Get inversion.
     *
     * @return float
     */
    public function getInversion() {
        return $this->inversion;
    }

    /**
     * Set inversion.
     *
     * @param float $inversion
     * @return ProductosPuntuacionInterface
     */
    public function setInversion($inversion) {
        $this->inversion = (float) $inversion;
        return $this;
    }

    /**
     * Get porcentaje.
     *
     * @return float
     */
    public function getPorcentaje() {
        return $this->porcentaje;
    }

    /**
     * Set porcentaje.
     *
     * @param float $porcentaje
     * @return ProductosPuntuacionInterface
     */
    public function setPorcentaje($porcentaje) {
        $this->porcentaje = (float) $porcentaje;
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
     * @return ProductosPuntuacionInterface
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
     * @return ProductosPuntuacionInterface
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
     * @return ProductosPuntuacionInterface
     */
    public function setEstatus($estatus) {
        $this->estatus = (int) $estatus;
        return $this;
    }

}
