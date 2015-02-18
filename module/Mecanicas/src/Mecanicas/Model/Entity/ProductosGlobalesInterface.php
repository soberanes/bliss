<?php

namespace Mecanicas\Model\Entity;

interface ProductosGlobalesInterface {

    /**
     * Get productosGlobalesId.
     *
     * @return int
     */
    public function getProductosGlobalesId();

    /**
     * Set productosGlobalesId.
     *
     * @param int $productosGlobalesId
     * @return ProductosGlobalesInterface
     */
    public function setProductosGlobalesId($productosGlobalesId);

    /**
     * Get sku.
     *
     * @return string
     */
    public function getSku();

    /**
     * Set sku.
     *
     * @param string $sku
     * @return ProductosGlobalesInterface
     */
    public function setSku($sku);

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre();

    /**
     * Set nombre.
     *
     * @param string $nombre
     * @return ProductosGlobalesInterface
     */
    public function setNombre($nombre);

    /**
     * Get presentacion.
     *
     * @return string
     */
    public function getPresentacion();

    /**
     * Set presentacion.
     *
     * @param string $presentacion
     * @return ProductosGlobalesInterface
     */
    public function setPresentacion($presentacion);

    /**
     * Get precioPiso.
     *
     * @return float
     */
    public function getPrecioPiso();

    /**
     * Set precioPiso.
     *
     * @param float $precioPiso
     * @return ProductosGlobalesInterface
     */
    public function setPrecioPiso($precioPiso);

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
     * @return ProductosGlobalesInterface
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
     * @return ProductosGlobalesInterface
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
     * @return ProductosGlobalesInterface
     */
    public function setEstatus($estatus);
}
