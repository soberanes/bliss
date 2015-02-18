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

class User implements ServiceManagerAwareInterface {

    /**
     * Construct
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }

    /**
     * getBasicInfo()
     * 
     * returns an array with the username,
     * email and displayname from the session
     * 
     * @return array get basic data users
     */
    public function getBasicInfo() {
        $auth = $this->getServiceManager()->get('zfcuser_auth_service');
        $data = array();
        if (!is_null($auth->getStorage()->read())) {
            $session = $auth->getStorage()->read();
            $data = array(
                'id' => $session->getId(),
                'username' => $session->getUsername(),
                'email' => $session->getEmail(),
                'displayName' => $session->getDisplayname(),
                'gid' => $session->getGid(),
                'parent' => $session->getParent(),
            );
        }
        return $data;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}
