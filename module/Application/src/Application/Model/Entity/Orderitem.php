<?php
/**
 * CookieShop - Class for Entities.
 * @category   Model
 * @package    Application\Model\Entity
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Application\Model\Entity;

class Orderitem{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var int 
     */
    protected $_orderid;
    /**
     *
     * @var int 
     */
    protected $_productid;
    /**
     *
     * @var int 
     */
    protected $_quantity;
    /**
     *
     * @var float 
     */
    protected $_price;
    /**
     *
     * @var float 
     */
    protected $_fees;
    /**
     *
     * @var float 
     */
    protected $_linetotal;

    /**
     * 
     * @return int
     */
    public function getId(){
        return $this->_id;
    }

    /**
     * 
     * @param int $id
     * @return \Application
     */
    public function setId($id){
        $this->_id=(int)$id;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getOrderid(){
        return $this->_orderid;
    }

    /**
     * 
     * @param int $orderid
     * @return \Application
     */
    public function setOrderid($orderid){
        $this->_orderid=(int)$orderid;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getProductid(){
        return $this->_productid;
    }

    /**
     * 
     * @param int $productid
     * @return \Application
     */
    public function setProductid($productid){
        $this->_productid=(int)$productid;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getQuantity(){
        return $this->_quantity;
    }

    /**
     * 
     * @param int $quantity
     * @return \Application
     */
    public function setQuantity($quantity){
        $this->_quantity=(int)$quantity;
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getPrice(){
        return $this->_price;
    }

    /**
     * 
     * @param float $price
     * @return \Application
     */
    public function setPrice($price){
        $this->_price=(float)$price;
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getFees(){
        return $this->_fees;
    }

    /**
     * 
     * @param float $fees
     * @return \Application
     */
    public function setFees($fees){
        $this->_fees=(float)$fees;
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getLinetotal(){
        return $this->_linetotal;
    }

    /**
     * 
     * @param float $linetotal
     * @return \Application
     */
    public function setLinetotal($linetotal){
        $this->_linetotal=(float)$linetotal;
        return $this;
    }

}
