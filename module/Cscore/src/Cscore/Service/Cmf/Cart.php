<?php
/**
 * CookieShop
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Cscore\Service\Cmf;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Cart implements ServiceManagerAwareInterface{ 
    
    /**
     * Contruct 
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }
    
    /**
     * Gets All Products
     * 
     * @return array
     */
    public function getAllCart($userid){
        $CartTable = $this->getServiceManager()
                ->get('Cscore\Model\CartTable');
        $allCart = $CartTable->fetchAllCarByUserId($userid);
       
        return $allCart;
    }
    /**
     * Elimina producto del carrito apartir de ID de usuario
     * 
     * @param type $userid
     * @param type $productid
     */
    public function deleteProduct($userid=0,$productid=0){
        $CartTable = $this->getServiceManager()
                ->get('Cscore\Model\CartTable');
        $CartTable->deteleProdut($userid,$productid);
    }
    /**
     * Agregar Producto
     * 
     * @param type $params
     */
    public function addProduct($params){
        $CartTable = $this->getServiceManager()
                ->get('Cscore\Model\CartTable');
        $CartTable->add($params);
    }
    /**
     * Vaciar Carrito
     * 
     * @param type $userid
     */
    public function emptyCart($userid){
        $CartTable = $this->getServiceManager()
                ->get('Cscore\Model\CartTable');
        $CartTable->emptyCartByUserid($userid);
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    }      
}