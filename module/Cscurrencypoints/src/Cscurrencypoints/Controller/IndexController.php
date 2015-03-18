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
        date_default_timezone_set('America/Mexico_City');
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
        
		// obtener el total de los puntos asignados y los puntos gastados
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

        //  obtener desgloce de puntos
        $puntuacion_service = $this->getServiceLocator()->get('puntuacion_service');

        $month = date('m');
        // $cuotas = $puntuacion_service->getCuotas($userId);



        // puntuacion para vendedores
        // Mostrar los vendedores, sus cuotas y lo que cumplieron de sus cuotas, con porcentaje y un total, 
        //      que seria la cuota del encargado 


        for ($i=3; $i < ($month+1) ; $i++) {
            $cuotas[$i]['data'] = $puntuacion_service->getCuotas($userId, $i);
        }

        // puntuacion para encargados
        


        //$this->_predump($cuotas);
        // $last_month = $puntuacion_service->getMonthLoaded($userId);

        // $familias = array(
        //     1 => 'Exterior LED',
        //     2 => 'Interior LED',
        //     3 => 'Exterior no LED',
        //     4 => 'interior no LED',
        // );

        $meses = array(
            1  => 'Enero',
            2  => 'Febrero',
            3  => 'Marzo',
            4  => 'Abril',
            5  => 'Mayo',
            6  => 'Junio',
            7  => 'Julio',
            8  => 'Agosto',
            9  => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        );


        return new ViewModel(array(
            'meses_text' => $meses,
            'cuotas'     => $cuotas,
            'credit_history' => $creditsHistory,
            'creditos'       => $credit
        ));
    }

    public function getBasicInfoService() {
        $core_service_cmf_user = $this->getServiceLocator()->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }

    private function _predump($arg){
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
        die;
    }

}
