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

class Credit implements ServiceManagerAwareInterface {

    private $creditsTable;

    /**
     * Contruct 
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    }

    /**
     * User Gets credits
     * 
     * @param type $id
     * @return type
     */
    public function getCreditByIdUser($id) {
        $CreditsTable = $this->getCreditsTable();
        return $CreditsTable->findId($id);
    }

    public function getCreditHistoryByIdUser($id) {
        $CreditshistoryTable = $this->getServiceManager()
                ->get('Cscore\Model\CreditshistoryTable');
        return $CreditshistoryTable->findByIdCredits($id);
    }

    public function getCreditsperiodsNameById($id) {
        $CreditsperiodsTable = $this->getServiceManager()
                ->get('Cscore\Model\CreditsperiodsTable');
        return $CreditsperiodsTable->getNameById($id);
    }

    public function setCreditsPaid($userid, $total) {
        $CreditsTable = $this->getCreditsTable();
        $isPayment = $CreditsTable->setPayments($userid, $total);
        if ($isPayment) {
            $params = array(
                'id_period' => $this->getCurrentPeriod(),
                'id_username' => $userid,
                'credits' => 0,
                'payments' => $total);
            $this->setCreditPaymentHistory($params);
        }
    }

    public function addCredit($userid, $total, $estatus = 1) {
        $CreditsTable = $this->getCreditsTable();
        $isCredit = $CreditsTable->addCredit($userid, $total);
        if ($isCredit) {
            $params = array(
                'id_period' => $this->getCurrentPeriod(),
                'id_username' => $userid,
                'credits' => $total,
                'payments' => 0,
                'status' => $estatus
            );
            $this->setCreditHistory($params);
        }
    }

    public function setCreditHistory($params) {
        $CreditshistoryTable = $this->getServiceManager()
                ->get('Cscore\Model\CreditshistoryTable');
        $CreditshistoryTable->write($params);
    }

    public function setCreditPaymentHistory($params) {
        $CreditshistoryTable = $this->getServiceManager()
                ->get('Cscore\Model\CreditshistoryTable');
        $CreditshistoryTable->setPaymentHistory($params);
    }

    public function getCurrentPeriod() {
        $CreditsperiodsTable = $this->getServiceManager()
                ->get('Cscore\Model\CreditsperiodsTable');
        return $CreditsperiodsTable->getIdPeriodNow();
    }

    public function getCreditsTable() {
        if (null === $this->creditsTable) {
            $this->creditsTable = $CreditsperiodsTable = $this->getServiceManager()
                    ->get('Cscore\Model\CreditsTable');
        }
        return $this->creditsTable;
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
