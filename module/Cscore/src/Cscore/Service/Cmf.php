<?php
/**
 * CookieShop
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Cscore\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class Cmf implements ServiceManagerAwareInterface{
    
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * Carrito
     * 
     * @return \Cscore\Service\Cmf\Cart
     */
    public function getCart(){
         return new \Cscore\Service\Cmf\Cart($this->getServiceManager());
    } 
    
    /**
     * Categorias
     * 
     * @return \Cscore\Service\Cmf\Category
     */
    public function getCategory(){
        return new \Cscore\Service\Cmf\Category($this->getServiceManager());
    } 
    
    /**
     * Checkout de pagos
     * 
     * @return \Cscore\Service\Cmf\Checkout
     */
    public function getCheckout(){
        return new \Cscore\Service\Cmf\Checkout($this->getServiceManager());
    }    
    
    /**
     * Creditos y monedas
     * 
     * @return \Cscore\Service\Cmf\Credit
     */
    public function getCredits(){
        return new \Cscore\Service\Cmf\Credit($this->getServiceManager());
    }
    
    /**
     * Informacion de usuario desde Sesion
     * 
     * @return \Cscore\Service\Cmf\User
     */
    public function getUser(){
        return new \Cscore\Service\Cmf\User($this->getServiceManager());
    } 
    
    /**
     * Productos
     * 
     * @return \Cscore\Service\Cmf\Product
     */
    public function getProduct(){
         return new \Cscore\Service\Cmf\Product($this->getServiceManager());
    } 
   
    /**
     * Obtiene Service Manager
     * 
     * @return type
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Inyecta Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Cscore\Service\Cmf
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    }   
}
