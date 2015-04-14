<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mailing\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;

class MailerSenderService extends EventProvider implements ServiceManagerAwareInterface {

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Set the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Uploader\Service\ProcessFile
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * 
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function getServiceManager() {
        return $this->serviceManager;
    }

    public function get($param) {
        return $this->getServiceManager()->get($param);
    }

    public function getEmailContent($items){
        $text = 'Petro7 te otorga tu código de Cinépolis: <b>'.$items.'</b>';
        return $text;
    }

    public function getEmailContentRecovery($userData, $password) {
        if (!empty($userData) && !empty($password)) {
            return '<body style="text-align: center;font-family: Arial;">'
                    . '<img src="https://googledrive.com/host/0B657LbPoW2yYTTd0Nk1fY0lCbTA" width="300" style="width:300px" />'
                    . '<h1>&iexcl;Recuperación de datos de sesión!</h1>'
                    . '<h2>' . $userData->getDisplayName() . '</h2>'
                    . '<p>A continuaci&oacute;n te enviamos tus datos de acceso a la plataforma:</p>'
                    . '<p><b>Usuario:</b> ' . $userData->getUsername() . '</p>'
                    . '<p><b>Contrase&ntilde;a:</b> ' . $password . '</p>'
                    . '<p>Ingresa a la plataforma <a href="http://goldvault.com.mx">www.goldvault.com.mx</a></p>'
                    . '</body>';
        }
        return '';
    }

}
