<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cscurrencypoints\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $arrUSerinfo = $this->getBasicInfoService();
        $userId = $arrUSerinfo['id'];
        $core_service_cmf_credits = $this->getServiceLocator()
                ->get('core_service_cmf_credits');
        $creditsHistory = $core_service_cmf_credits->getCredits()
                ->getCreditHistoryByIdUser($userId);
        $i = 0;
        foreach ($creditsHistory as $value) {
            $name = $core_service_cmf_credits->getCredits()
                    ->getCreditsperiodsNameById($value['id_period']);
            $creditsHistory[$i]['name_period'] = $name;
            ++$i;
        }

        $credits_history_table = $this->getServiceLocator()
                ->get('Application\Model\CreditshistoryTable');

        $user_credit_history = $credits_history_table->findAllById(array(
            'where' => array('id_username' => $userId),
            'order' => 'id ASC'
        ));
        $invoiceDetailDao = $this->getServiceLocator()->get('Facturacion/Model/FacturacionDetalle');
        $invoiceDetailObj = $invoiceDetailDao->getDetalle($userId);


//         obtener el total de los puntos asignados y los puntos gastados
        $credits = 0;
        $payments = 0;
        foreach ($user_credit_history as $credit_history) {
            $credits += $credit_history['credits'];
            $payments += $credit_history['payments'];
        }

        // obtener los puntos actuales
        $credits_table = $this->getServiceLocator()->get('Application\Model\CreditsTable');
        $current_credit = $credits_table->fetchOneById(array(
            'where' => array('user_id' => $userId),
            'order' => 'id ASC'
        ));

        $credit = array(
            'total' => $credits,
            'canjeados' => $payments,
            'ganados' => $credits,
            'actuales' => $current_credit['credit']
        );
        return new ViewModel(array('credit_history' => $creditsHistory, 'creditos' => $credit, 'invoices' => $invoiceDetailObj));
    }

    public function getBasicInfoService() {
        $core_service_cmf_user = $this->getServiceLocator()->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }

}
