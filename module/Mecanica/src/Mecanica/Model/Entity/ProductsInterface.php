<?php

namespace Mecanica\Model\Entity;

interface ProductsInterface {

	/**
     * Get productoId.
     *
     * @return int
     */
    public function getProductoId();

    /**
     * Set productoId.
     *
     * @param int $productoId
     * @return ProductsInterface
     */
    public function setProductoId($productoId);
    
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
     * @return ProductsInterface
     */
    public function setSku($sku);
    
    /**
     * Get familiaId.
     *
     * @return int
     */
    public function getFamiliaId();

    /**
     * Set familiaId.
     *
     * @param int $familiaId
     * @return ProductsInterface
     */
    public function setFamiliaId($familiaId);
    
    /**
     * Get creationDate.
     *
     * @return int
     */
    public function getCreationDate();

    /**
     * Set creationDate.
     *
     * @param int $creationDate
     * @return ProductsInterface
     */
    public function setCreationDate($creationDate);
    
    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set status.
     *
     * @param int $status
     * @return ProductsInterface
     */
    public function setStatus($status);

}