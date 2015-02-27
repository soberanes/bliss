<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cspermission\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\MvcEvent;
use Cspermission\Model\Aclbasic;

class Permission extends AbstractPlugin {

    protected $em;
    protected $sm;
    protected $acl;
    public $ZfcUserAuth;

    public function doPermission(MvcEvent $e) {
        $this->setSm($e->getApplication()->getServiceManager());
        $matches = $e->getRouteMatch();

        $controller = $matches->getParam('controller');
        $action = $matches->getParam('action');
        $cache = $this->getSm()->get('cache');
        $auth = $this->getSm()->get('zfcuser_auth_service');
        if ($auth->getStorage()->read()) {
            $gid = $auth->getStorage()->read()->getGid();
            $param = array('cache' => $cache, 'idcache' => $gid);
            $this->acl = new Aclbasic($param, $this->getSm());
        }

        $resource = $controller . '/' . $action;
        //echo "<pre>";var_dump($resource);echo "</pre>";die;
        switch ($resource) {

            case 'permisiondeny/deny': break;
            case 'zfcuser/login':
                if ($auth->hasIdentity()) {
                    $response = $e->getResponse();
                    $response->setStatusCode(302);
                    $response->getHeaders()->addHeaderLine('Location', '/');
                    $e->stopPropagation();
                }
                break;
            case 'zfcuser/logout': break;
            case 'zfcuser/recovery': break;
            case 'zfcuser/register': break;
            case 'Registro\Controller\Index/index': break;
            case 'Registro\Controller\Index/getinfo': break;
            case 'Registro\Controller\Index/getsucursal': break;
            case 'Registro\Controller\Index/save': break;
            case 'Mailing\Controller\Index/index': break;
//            case 'Facturacion\Controller\Index/upload': break;

            default:
                $isa = false;
                if ($auth->hasIdentity()) {
                    $idRessource = $this->acl->findResourceId($resource);
                    $isRole = $this->acl->isRole($gid);
                    if ($idRessource <= 0) {
                        $isa = false;
                    } else {
                        $isa = $this->_isAllowed((int) $gid, $idRessource);
                    }
                }
                if (!$auth->hasIdentity() || !$isa) {
                    $router = $e->getRouter();
                    if ($resource === 'Application\Controller\Index/index') {
                        $url = $router->assemble(array(), array('name' => 'zfcuser/login'));
                    } else {
                        $url = $router->assemble(array(), array('name' => 'permisiondeny'));
                    }
                    $response = $e->getResponse();
                    $response->setStatusCode(302);
                    $response->getHeaders()->addHeaderLine('Location', $url);
                    $e->stopPropagation();
                }
                break;
        }
    }

    public function getSm() {
        return $this->sm;
    }

    public function setSm(ServiceManager $sm) {
        $this->sm = $sm;
    }

    public function _isAllowed($role, $resource) {
        $isAllowed = ($this->acl->isAllowed($role, $resource) ? true : false);
        return $isAllowed;
    }

}
