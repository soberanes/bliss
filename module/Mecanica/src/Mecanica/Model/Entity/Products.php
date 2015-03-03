<?php

namespace Mecanica\Model\Entity;

class Products implements ProductsInterface {

	/**
     * @var int
     */
    protected $productoId;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var int
     */
    protected $familiaId;

    /**
     * @var int
     */
    protected $creationDate;

    /**
     * @var int
     */
    protected $status;

    /**
     * Get productoId.
     *
     * @return int
     */
    public function getProductoId() {
        return $this->productoId;
    }

    /**
     * Set productoId.
     *
     * @param int $productoId
     * @return ProductsInterface
     */
    public function setProductoId($productoId) {
        $this->productoId = (int) $productoId;
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
     * @return ProductsInterface
     */
    public function setSku($sku) {
        $this->sku = (string) $sku;
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
     * @return ProductsInterface
     */
    public function setFamiliaId($familiaId) {
        $this->familiaId = (int) $familiaId;
        return $this;
    }
    
    /**
     * Get creationDate.
     *
     * @return int
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Set creationDate.
     *
     * @param int $creationDate
     * @return ProductsInterface
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = (int) $creationDate;
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
     * @return ProductsInterface
     */
    public function setStatus($status) {
        $this->status = (int) $status;
        return $this;
    }
}