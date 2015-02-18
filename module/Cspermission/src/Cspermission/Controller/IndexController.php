<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Cspermission\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{    
    public function denyAction(){
        $basePath = $this->getRequest()->getBasePath();
        echo '<h1>Access Denied</h1><br/><a href="'.$basePath.'">Home</a>';
        return $this->response;
    }
}