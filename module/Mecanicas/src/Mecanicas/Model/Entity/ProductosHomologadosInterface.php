<?php

namespace Mecanicas\Model\Entity;

interface ProductosHomologadosInterface {

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
     * @return ProductosDistribuidorInterface
     */
    public function setProductosHomologadosId($productosHomologadosId);

    /**
     * Get mayoristaId.
     *
     * @return int
     */
    public function getMayoristaId();

    /**
     * Set mayoristaId.
     *
     * @param int $mayoristaId
     * @return ProductosDistribuidorInterface
     */
    public function setMayoristaId($mayoristaId);

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
     * @return ProductosDistribuidorInterface
     */
    public function setProductoGlobalId($productoGlobalId);

    /**
     * Get skuMayorista.
     *
     * @return int
     */
    public function getSkuMayorista();

    /**
     * Set skuMayorista.
     *
     * @param int $skuMayorista
     * @return ProductosDistribuidorInterface
     */
    public function setSkuMayorista($skuMayorista);

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
     * @return ProductosDistribuidorInterface
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
     * @return ProductosDistribuidorInterface
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
     * @return ProductosDistribuidorInterface
     */
    public function setEstatus($estatus);
}
