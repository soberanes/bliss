<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Cscheckout\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function checkoutAction() {
        $viewModel = new ViewModel();
        $date = new \DateTime('now', new \DateTimeZone('America/Mexico_City'));
        $now = (int) $date->getTimestamp();
        try {
            $core_service_cmf_credits = $this->getServiceLocator()
                    ->get('core_service_cmf_credits');
            $arrUserinfo = $this->getBasicInfoService();
            $core_service_cmf_cart = $this->getServiceLocator()
                    ->get('core_service_cmf_cart');
            $allCart = $core_service_cmf_cart->getCart()
                    ->getAllCart($arrUserinfo['id']);
            $cscheckout_service = $this->getServiceLocator()
                    ->get('core_service_cmf_checkout');
            $wallet = $core_service_cmf_credits->getCredits()
                    ->getCreditByIdUser($arrUserinfo['id']);
            $paramsOrder = $cscheckout_service->getCheckout()
                    ->setOrder($allCart, $wallet['credit']);

            if (((int) $paramsOrder['order']) > 0) {
                $core_service_cmf_credits->getCredits()->setCreditsPaid(
                        $arrUserinfo['id'], ((int) $paramsOrder['total']));
            }
            $credit = $wallet['credit'];
            $order = $paramsOrder['total'];
            $disponibles = $credit - $order;
            $this->sendMail($arrUserinfo, $paramsOrder, $allCart, $disponibles);
            $viewModel->setVariable('paramsOrder', array(
                'order' => $paramsOrder['order'],
                'date' => $paramsOrder['order_date'],
                'usename' => $arrUserinfo['displayName'],
                'allCart' => $allCart
            ));
        } catch (\Exception $e) {

            $viewModel->setVariable('paramsOrder', array(
                'order' => 0,
                'date' => $now,
                'usename' => $e->getMessage(),
                'allCart' => array()
            ));
        }

        return $viewModel;
    }

    public function getBasicInfoService() {
        $core_service_cmf_user = $this->getServiceLocator()
                ->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }

    protected function sendMail($arrUserinfo, $orderInfo, $cartContent, $disponibles) {
        $mailService = $this->getServiceLocator()->get('mailer_sender_service');
        return $mailService->sendMailCheckout($arrUserinfo, $orderInfo, $cartContent, $disponibles);
    }

}
