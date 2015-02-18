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

class Ordercheck{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var int 
     */
    protected $_idsecurity;
    /**
     *
     * @var int 
     */
    protected $_userid;
    /**
     *
     * @var float 
     */
    protected $_total;
    /**
     *
     * @var int 
     */
    protected $_orderdate;
    /**
     *
     * @var int 
     */
    protected $_ip;
    /**
     *
     * @var int 
     */
    protected $_orderstatus;

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
    public function getIdsecurity(){
        return $this->_idsecurity;
    }

    /**
     * 
     * @param int $idsecurity
     * @return \Application
     */
    public function setIdsecurity($idsecurity){
        $this->_idsecurity=(int)$idsecurity;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getUserid(){
        return $this->_userid;
    }

    /**
     * 
     * @param int $userid
     * @return \Application
     */
    public function setUserid($userid){
        $this->_userid=(int)$userid;
        return $this;
    }

    /**
     * 
     * @return float
     */
    public function getTotal(){
        return $this->_total;
    }

    /**
     * 
     * @param float $total
     * @return \Application
     */
    public function setTotal($total){
        $this->_total=(float)$total;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getOrderdate(){
        return $this->_orderdate;
    }

    /**
     * 
     * @param int $orderdate
     * @return \Application
     */
    public function setOrderdate($orderdate){
        $this->_orderdate=(int)$orderdate;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getIp(){
        return $this->_ip;
    }

    /**
     * 
     * @param int $ip
     * @return \Application
     */
    public function setIp($ip){
        $this->_ip=(int)$ip;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getOrderstatus(){
        return $this->_orderstatus;
    }

    /**
     * 
     * @param int $orderstatus
     * @return \Application
     */
    public function setOrderstatus($orderstatus){
        $this->_orderstatus=(int)$orderstatus;
        return $this;
    }

}
