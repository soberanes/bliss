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

    public function getUrl() {
        return 'http://' . $_SERVER['HTTP_HOST'];
    }

    public function sendPending() {
        $registroDao = $this->get('Registro_Model_UserInfoDao');
        $usuarios = $registroDao->getPendientes(1);
        $mailer = $this->get('mailer_service');
        foreach ($usuarios as $user) {
            $data['display_name'] = $user->getNombre();
            $data['email'] = $user->getEmail();
            $data['password'] = str_replace('/', '', $user->getBirthdate());
            $mailer->setSubject('Bienvenido a Brilla con Tecnolite');
            $mailer->setTo($user->getEmail());
            $mailer->setFrom('noreply@tecnolite.com.mx');
            $mailer->setBody($this->getEmailContentValidate($data));
            $mailer->send();
            $user->setEstatus(2);
            $registroDao->changeEstatus($user);
        }
    }

    public function sendMailPreRegister($userData, $password) {
        $mailer = $this->get('mailer_service');

        $data['display_name'] = $userData->getDisplayName();
        $data['email'] = $userData->getEmail();
        $data['password'] = $password;

        $mailer->setSubject('Bienvenido a Brilla con Tecnolite');
        $mailer->setTo($userData->getEmail());
        $mailer->setFrom('noreply@tecnolite.com.mx');
        $mailer->setBody($this->getEmailContentValidate($data));
        if ($mailer->send()) {
            return true;
        }
        return false;
    }

    public function sendMailRegister(array $data) {
        $mailer = $this->get('mailer_service');
        $mailer->setSubject('Bienvenido a Brilla con Tecnolite');
        $mailer->setTo($data['email']);
        $mailer->setFrom('noreply@tecnolite.com.mx');
        $mailer->setBody($this->getEmailContent());
        if ($mailer->send()) {
            return true;
        }
        return false;
    }

    public function sendByUserIdRecovery($userId) {
        $mailer = $this->get('mailer_service');
        $userDao = $this->get('Registro_Model_UserInfoDao');
        $userInfo = $userDao->findByUserId($userId);
        if ($userInfo !== false) {
            $data['display_name'] = $userInfo->nombre;
            $data['email'] = $userInfo->email;
            $data['password'] = str_replace('/', '', $userInfo->birthdate);
            $mailer->setSubject('Bienvenido a Goldvault');
            $mailer->setTo($userInfo->email);
            $mailer->setFrom('noreply@goldvault.com.mx');
            if ((int) $userInfo->estatus > 0) {
                $mailer->setBody($this->getEmailContentRecovery($data));
            }else{
                $mailer->setBody($this->getEmailContent());
            }
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    }

    public function getEmailContent() {
        return '<body style="text-align: center;font-family: Arial;">'
                . '<img src="' . $this->getUrl() . '/images/gold_logo.png" width="300" style="width:300px" />'
                . '<h1>&iexcl;Felicidades!</h1>'
                . '<p>Hemos recibido tu registro en <a href="http://goldvault.com.mx">goldvault.com.mx</a>.</p>'
                . '<p>El sistema está validando tu información en este momento, en breve recibirás un email de confirmación con tu usuario y contraseña.</p>'
                . '<p>Si necesitas ayuda, de favor da click <a href="http://www.adventaprogramascomerciales.com/helpdesk/index.php?pc=51">aqu&iacute;</a>.</p>'
                . '</body>';
    }

    public function getEmailContentValidate(array $data) {
        if (!empty($data)) {
            return '<body style="text-align: center;font-family: Arial;">'
                    . '<img src="' . $this->getUrl() . '/images/gold_logo.png" width="300" style="width:300px" />'
                    . '<h1>&iexcl;Bienvenido a la plataforma!</h1>'
                    . '<h2>' . $this->encode($data['display_name']) . '</h2>'
                    . '<p>A continuaci&oacute;n te enviamos tus datos de acceso a la plataforma:</p>'
                    . '<p><b>Usuario:</b> ' . $data['email'] . '</p>'
                    . '<p><b>Contrase&ntilde;a:</b> ' . $data['password'] . '</p>'
                    . '<p>Ingresa a la plataforma <a href="http://goldvault.com.mx">www.goldvault.com.mx</a></p>'
                    . '</body>';
        }
        return '';
    }

    public function getEmailContentRecovery(array $data) {
        if (!empty($data)) {
            return '<body style="text-align: center;font-family: Arial;">'
                    . '<img src="' . $this->getUrl() . '/images/gold_logo.png" width="300" style="width:300px" />'
                    . '<h1>&iexcl;Recuperación de datos de sesión!</h1>'
                    . '<h2>' . $this->encode($data['display_name']) . '</h2>'
                    . '<p>A continuaci&oacute;n te enviamos tus datos de acceso a la plataforma:</p>'
                    . '<p><b>Usuario:</b> ' . $data['email'] . '</p>'
                    . '<p><b>Contrase&ntilde;a:</b> ' . $data['password'] . '</p>'
                    . '<p>Ingresa a la plataforma <a href="http://goldvault.com.mx">www.goldvault.com.mx</a></p>'
                    . '</body>';
        }
        return '';
    }

    public function sendMailCheckout($arrUserinfo, $orderInfo, $cartContent, $disponibles) {
        $mailer = $this->get('mailer_service');
        $mailer->setSubject('¡Felicidades!');
        $mailer->setTo($arrUserinfo['email']);
        $mailer->setFrom('noreply@goldvault.com.mx');
        $content = $this->getCheckoutContent($arrUserinfo, $orderInfo, $cartContent, $disponibles);
        $mailer->setBody($content);
        if ($mailer->send()) {
            return true;
        }
        return false;
    }

    public function getCheckoutContent($arrUserinfo, $orderInfo, $cartContent, $disponibles) {
        $userDao = $this->get('Registro_Model_UserInfoDao');
        $cpDao = $this->get('Registro_Model_CatCpDao');
        $userInfo = $userDao->findByUserId($arrUserinfo['id']);
        $noInt = $userInfo->getNoInt() === '' ? '-' : $userInfo->getNoInt();
//        $tel = $userInfo->getTelefono() === '' ? '-' : $userInfo->getTelefono();
        $tel = '-';
        $cel = $userInfo->getCelular() === '' ? '-' : $userInfo->getCelular();
        $cpObj = $cpDao->findByIdCp($userInfo->getCpId());
        $host = $this->getUrl();
        $html = '
<html>
    <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        
        <style type="text/css">
            body{
                font-family: arial;
            }
            .titulos{
                background-color: #616161;
                color: #FFF;
                font-size: 19px;
                padding: 5px 25px;
            }
            .usuario{
                color: #525252;
                font-size: 36px;
                font-weight: 200;
                text-align: center;
            }
            .leyenda{
                color: #525252;
                font-size: 16px;
                text-align: center;
                padding: 20px 0px 10px 0px;
            }
            .datos{
                background-color: #e0e0e0;
                font-size: 16px;
                font-weight: bold;
                color: #404040;
            }
            .datosuno{
                padding: 5px 25px;
            }

            .datosdos{
                widows: 350px;
                background-color: #525252;
                font-size: 18px;
                font-weight: bold;
                color: #FFF;
            }
            .datostres{
                padding: 5px 25px;
            }
            .titProd{
                background-color: #e0e0e0;
                padding: 5px 37px;
            }
            table{
                width: 900px;
            }
            .datoscuatro{
                width: 550px;
            }
        </style>
    </head>
    <body>
        <table width="900" >
            <tr>
                <td colspan="2" ><center><img src="' . $host . '/images/gold_logo.png" alt=""/></center></td>
            </tr>
            <tr>
                <td colspan="2" class="usuario">' . $this->encode($arrUserinfo['displayName']) . '</td>
            </tr>
            <tr>
                <td colspan="2" class="leyenda">Tu solicitud se ha realizado con &eacute;xito, a continuaci&oacute;n te damos el detalle:</td>
            </tr>
            <tr>
                <td colspan="2" class="titulos">Detalle del Pedido</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">N&uacute;mero de Orden:</td>
                <td class="datoscuatro">#' . $orderInfo['order'] . '</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Fecha de Canje:</td>
                <td class="datoscuatro">' . date('d/m/Y', $orderInfo['order_date']) . '</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Total de Puntos Canjeados:</td>
                <td class="datoscuatro">' . number_format($orderInfo['total']) . '</td>
            </tr>
            <tr class="datosdos">
                <td class="datostres">Puntos disponibles para Canje:</td>
                <td class="datoscuatro">' . number_format($disponibles) . '</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>		
            <tr>
                <td colspan="2" class="titulos">Detalle del pedido</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="titProd">Producto</td>
                            <td class="titProd">SKU</td>
                            <td class="titProd">Imagen</td>
                            <td class="titProd">Categoría</td>
                            <td class="titProd">Cant.</td>
                            <td class="titProd">Puntos</td>
                            <td class="titProd">Subtotal</td>
                        </tr>';
        foreach ($cartContent as $cart) {
            $html.='<tr>
                            <td>' . $this->encode($cart['other_sku']) . '</td>
                            <td>' . $cart['sku'] . '</td>
                            <td><img width="100" src="' . $host . '/img/product/' . $cart['full_image'] . '"/></td>
                            <td>' . $this->encode($cart['category']) . '</td>
                            <td>' . $cart['quantity'] . '</td>
                            <td>' . number_format($cart['price'] / $cart['quantity']) . '</td>
                            <td>' . number_format($cart['line_total']) . '</td>
                        </tr>';
        }
        $html.='</table>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="2" class="titulos">Informaci&oacute;n del Usuario</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Nombre:</td>
                <td class="datoscuatro">' . $this->encode($arrUserinfo['displayName']) . '</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Tel&eacute;fono Fijo:</td>
                <td class="datoscuatro">' . $tel . '</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Celular:</td>
                <td class="datoscuatro">' . $cel . '</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Email:</td>
                <td class="datoscuatro">' . $arrUserinfo['email'] . '</td>
            </tr>
            <tr class="datos">
                <td class="datosuno">Domicilio:</td>
                <td class="datoscuatro">' . $this->encode($userInfo->getDomicilio()) .
                ', Interior: ' . $noInt .
                ', Colonia: ' . $this->encode($cpObj->getColonia()) .
                ', Ciudad o Municipio: ' . $this->encode($cpObj->getMpio()) .
                ', Estado: ' . $this->encode($cpObj->getEdo()) .
                ', C.P.:' . $cpObj->getCp() .
                '</td>
            </tr>' .
//            <tr class="datos">
//                <td class="datosuno">Referencias:</td>
//                <td class="datoscuatro">' . $userInfo->getReferencias() . '</td>
//            </tr>
//            <tr>
//                <td colspan="2"><img src="' . $host . '/images/mail/footer.jpg" alt=""></td>
//            </tr>
                '</table>
    </body>
</html>';
        return $html;
    }

    private function encode($text) {
        return htmlentities(utf8_decode($text), ENT_SUBSTITUTE, 'ISO-8859-1');
    }

}
