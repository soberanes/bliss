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

class Product{
    /**
     *
     * @var int 
     */
    protected $_id;
    /**
     *
     * @var string 
     */
    protected $_sku;
    /**
     *
     * @var string 
     */
    protected $_othersku;
    /**
     *
     * @var string 
     */
    protected $_description;
    /**
     *
     * @var string 
     */
    protected $_thumbimage;
    /**
     *
     * @var string 
     */
    protected $_fullimage;
    /**
     *
     * @var int 
     */
    protected $_lastupdate;
    /**
     *
     * @var int 
     */
    protected $_productstatus;

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
     * @return string
     */
    public function getSku(){
        return $this->_sku;
    }

    /**
     * 
     * @param string $sku
     * @return \Application
     */
    public function setSku($sku){
        $this->_sku=(string)$sku;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getOthersku(){
        return $this->_othersku;
    }

    /**
     * 
     * @param string $othersku
     * @return \Application
     */
    public function setOthersku($othersku){
        $this->_othersku=(string)$othersku;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getDescription(){
        return $this->_description;
    }

    /**
     * 
     * @param string $description
     * @return \Application
     */
    public function setDescription($description){
        $this->_description=(string)$description;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getThumbimage(){
        return $this->_thumbimage;
    }

    /**
     * 
     * @param string $thumbimage
     * @return \Application
     */
    public function setThumbimage($thumbimage){
        $this->_thumbimage=(string)$thumbimage;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getFullimage(){
        return $this->_fullimage;
    }

    /**
     * 
     * @param string $fullimage
     * @return \Application
     */
    public function setFullimage($fullimage){
        $this->_fullimage=(string)$fullimage;
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

    /**
     * 
     * @return int
     */
    public function getProductstatus(){
        return $this->_productstatus;
    }

    /**
     * 
     * @param int $productstatus
     * @return \Application
     */
    public function setProductstatus($productstatus){
        $this->_productstatus=(int)$productstatus;
        return $this;
    }

}
