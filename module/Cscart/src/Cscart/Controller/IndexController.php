<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Cscart\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function carritoAction() {
        $arrUserinfo = $this->getBasicInfoService();
        $matches = $this->getEvent()->getRouteMatch();
        $idtask = (int) $matches->getParam('idtask');
        $userid = (int) $arrUserinfo['id'];
        $productid = (int) $this->getRequest()->getPost('product_id');
        $request = $this->getRequest();

        $core_service_cmf_cart = $this->getServiceLocator()
                ->get('core_service_cmf_cart');
        
        if ($request->isPost() && $idtask === 1) {
            $core_service_cmf_cart->getCart()->deleteProduct($userid, $productid);
            $this->redirect()->toRoute('cscart_controller_index');
        } elseif ($request->isPost() && $idtask === 2) {
            $quantity = (int) $this->getRequest()->getPost('quantity');
            $price = (int) $this->getRequest()->getPost('price');
            $line_total = $quantity * $price;
            
            
            
            $params = array(
                'user_id' => $userid,
                'product_id' => $productid,
                'quantity' => $quantity,
                'price' => $price,
                'line_total' => $line_total
            );
            
            
            
            $core_service_cmf_cart->getCart()->addProduct($params);
            $this->redirect()->toRoute('cscart_controller_index');
        }

        $allcart = $core_service_cmf_cart->getCart()->getAllCart($arrUserinfo['id']);
        $isCanjeOpen = $this->isCanjeOpen();
        $barCredit = $this->layout()->getVariable('barCredit');
        $puntos = $barCredit['credit'];
        return new ViewModel(array('allcart' => $allcart, 'puntos' => $puntos, 'isCanjeOpen' => $isCanjeOpen));
    }

    public function getBasicInfoService() {
        $core_service_cmf_user = $this->getServiceLocator()->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }

    private function isCanjeOpen() {
//        $canjePeriods = $this->getServiceLocator()->get('canje_periods');
        $canjePeriodsMapper = $this->getServiceLocator()->get('Csproductcmf\Model\PeriodoscanjeTable');
        $canjePeriods = $canjePeriodsMapper->readPeriodos();
        foreach ($canjePeriods as $periodo) {
            $time = time();
            if ($time >= $periodo['from'] && $time <= $periodo['to']) {
                return true;
            }
        }
        return false;
    }

}
