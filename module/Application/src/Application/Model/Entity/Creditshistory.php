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

class Creditshistory{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var int 
     */
    protected $_idperiod;
    /**
     *
     * @var int 
     */
    protected $_idusername;
    /**
     *
     * @var float 
     */
    protected $_credits;
    /**
     *
     * @var float 
     */
    protected $_payments;

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
    public function getIdperiod(){
        return $this->_idperiod;
    }

    /**
     * 
     * @param int $idperiod
     * @return \Application
     */
    public function setIdperiod($idperiod){
        $this->_idperiod=(int)$idperiod;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getIdusername(){
        return $this->_idusername;
    }

    /**
     * 
     * @param int $idusername
     * @return \Application
     */
    public function setIdusername($idusername){
        $this->_idusername=(int)$idusername;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getCredits(){
        return $this->_credits;
    }

    /**
     * 
     * @param int $credits
     * @return \Application
     */
    public function setCredits($credits){
        $this->_credits=(float)$credits;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getPayments(){
        return $this->_payments;
    }

    /**
     * 
     * @param int $payments
     * @return \Application
     */
    public function setPayments($payments){
        $this->_payments=(float)$payments;
        return $this;
    }

}
