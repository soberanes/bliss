<?php

namespace Mecanicas\Model\Entity;

class ProductosHomologados implements ProductosDistribuidorInterface {

    /**
     * @var int
     */
    protected $productosHomologadosId;

    /**
     * @var int
     */
    protected $mayoristaId;

    /**
     * @var int
     */
    protected $productoGlobalId;

    /**
     * @var int
     */
    protected $skuMayorista;

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
     * @return ProductosDistribuidorInterface
     */
    public function setProductosHomologadosId($productosHomologadosId) {
        $this->productosDistribuidorId = (int) $productosHomologadosId;
        return $this;
    }

    /**
     * Get mayoristaId.
     *
     * @return int
     */
    public function getMayoristaId() {
        return $this->mayoristaId;
    }

    /**
     * Set mayoristaId.
     *
     * @param int $mayoristaId
     * @return ProductosDistribuidorInterface
     */
    public function setMayoristaId($mayoristaId) {
        $this->mayoristaId = (int) $mayoristaId;
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
     * @return ProductosDistribuidorInterface
     */
    public function setProductoGlobalId($productoGlobalId) {
        $this->productoGlobalId = (int) $productoGlobalId;
        return $this;
    }

    /**
     * Get skuMayorista.
     *
     * @return int
     */
    public function getSkuMayorista() {
        return $this->skuMayorista;
    }

    /**
     * Set skuMayorista.
     *
     * @param int $skuMayorista
     * @return ProductosDistribuidorInterface
     */
    public function setSkuMayorista($skuMayorista) {
        $this->skuMayorista = (int) $skuMayorista;
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
     * @return ProductosDistribuidorInterface
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
     * @return ProductosDistribuidorInterface
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
     * @return ProductosDistribuidorInterface
     */
    public function setEstatus($estatus) {
        $this->estatus = (int) $estatus;
        return $this;
    }

}
