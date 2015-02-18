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

class Category implements ServiceManagerAwareInterface{ 
    
    /**
     * Construct
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }
    
    /**
     * get all categories
     * 
     * @return type
     */
    public function getCategories(){
        $CategoryTable = $this->getServiceManager()
                ->get('Cscore\Model\CategoryTable');
        return $CategoryTable->fetchAll();        
    }
    
    /**
     * get all categories
     * 
     * @return type
     */
    public function getCategoriebyid($id){
        $CategoryTable = $this->getServiceManager()
                ->get('Cscore\Model\CategoryTable');
        return $CategoryTable->findid($id);        
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
