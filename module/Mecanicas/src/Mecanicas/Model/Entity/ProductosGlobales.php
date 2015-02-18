<?php

namespace Mecanicas\Model\Entity;

class ProductosGlobales implements ProductosGlobalesInterface {

    /**
     * @var int
     */
    protected $productosGlobalesId;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $presentacion;

    /**
     * @var float
     */
    protected $precioPiso;

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
     * Get productosGlobalesId.
     *
     * @return int
     */
    public function getProductosGlobalesId() {
        return $this->productosGlobalesId;
    }

    /**
     * Set productosGlobalesId.
     *
     * @param int $productosGlobalesId
     * @return ProductosGlobalesInterface
     */
    public function setProductosGlobalesId($productosGlobalesId) {
        $this->productosGlobalesId = (int) $productosGlobalesId;
        return $this;
    }

    /**
     * Get sku.
     *
     * @return string
     */
    public function getSku() {
        return $this->sku;
    }

    /**
     * Set sku.
     *
     * @param string $sku
     * @return ProductosGlobalesInterface
     */
    public function setSku($sku) {
        $this->sku = (string) $sku;
        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     * @return ProductosGlobalesInterface
     */
    public function setNombre($nombre) {
        $this->nombre = (string) $nombre;
        return $this;
    }

    /**
     * Get presentacion.
     *
     * @return string
     */
    public function getPresentacion() {
        return $this->presentacion;
    }

    /**
     * Set presentacion.
     *
     * @param string $presentacion
     * @return ProductosGlobalesInterface
     */
    public function setPresentacion($presentacion) {
        $this->presentacion = (string) $presentacion;
        return $this;
    }

    /**
     * Get precioPiso.
     *
     * @return float
     */
    public function getPrecioPiso() {
        return $this->precioPiso;
    }

    /**
     * Set precioPiso.
     *
     * @param float $precioPiso
     * @return ProductosGlobalesInterface
     */
    public function setPrecioPiso($precioPiso) {
        $this->precioPiso = (float) $precioPiso;
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
     * @return ProductosGlobalesInterface
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
     * @return ProductosGlobalesInterface
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
     * @return ProductosGlobalesInterface
     */
    public function setEstatus($estatus) {
        $this->estatus = (int) $estatus;
        return $this;
    }

}
