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

class Credits{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var int 
     */
    protected $_userid;
    /**
     *
     * @var int 
     */
    protected $_credit;
    /**
     *
     * @var int 
     */
    protected $_lastupdate;

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
     * @return int
     */
    public function getCredit(){
        return $this->_credit;
    }

    /**
     * 
     * @param int $credit
     * @return \Application
     */
    public function setCredit($credit){
        $this->_credit=(float)$credit;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getLastupdate(){
        return $this->_lastupdate;
    }

    /**
     * 
     * @param int $lastupdate
     * @return \Application
     */
    public function setLastupdate($lastupdate){
        $this->_lastupdate=(int)$lastupdate;
        return $this;
    }

}
