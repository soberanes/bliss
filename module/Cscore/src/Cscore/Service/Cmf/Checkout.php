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
class Checkout implements ServiceManagerAwareInterface{ 
    
    /**
     *
     * @var type 
     */
    protected $orderid;
    
    /**
     *
     * @var type 
     */
    protected $total;
    
    /**
     * Contruct Set ServiceManager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager) {
        $this->setServiceManager($serviceManager);
    } 
    /**
     * setStepOne(), params keys:
     * 
     * @param type $params
     * @return type
     */
    public function setStepOne($params){
        $OrderTable = $this->getServiceManager()
                ->get('Cscore\Model\OrderTable');
        return $OrderTable->insertOrder($params);
    }
    /**
     * setStepTwo(), params keys:
     * 
     * @param type $params
     */
    public function setStepTwo($params){
        $OrderTable = $this->getServiceManager()
                ->get('Cscore\Model\OrderTable');
        $OrderhistoryTable = $this->getServiceManager()
                ->get('Cscore\Model\OrderhistoryTable');
        $OrderitemTable = $this->getServiceManager()
                ->get('Cscore\Model\OrderitemTable');
 
        $OrderhistoryTable->insertHistory($params);
        $OrderitemTable->insertItem($params);        
        $OrderTable->updateStatus(
                $params['setStepTwo']['id'],
                $params['setStepTwo']['order_status']);
    }
    /**
     * 
     * @param type $params
     */
    public function setStepThree($params){
       $PaymentTable = $this->getServiceManager()
                ->get('Cscore\Model\PaymentTable');        
        $OrderTable = $this->getServiceManager()
                ->get('Cscore\Model\OrderTable');         
        $PaymentTable->insertPayment($params);
        $OrderTable->updateStatus(
                $params['setStepTwo']['id'],
                $params['setStepTwo']['order_status']);
    }
    /**
     * 
     * @param type $allCart
     * @param type $wallet
     * @return type
     * @throws \Exception
     */
    public function setOrder($allCart,$wallet){
        $remote = new \Zend\Http\PhpEnvironment\RemoteAddress;
        $ip = sprintf('%u', ip2long($remote->getIpAddress()));
        $date = new \DateTime('now', new \DateTimeZone('America/Mexico_City')); 
        $now = (int) $date->getTimestamp();
        $params = array();
        if(count($allCart)>0){
            $line_total = 0;
            $userid = 0;
            foreach ($allCart as $item) { 
                $subtotal = (float) $item['line_total'];
                $line_total += $subtotal;
                $userid = (int)$item['user_id'];
            }
            $wallet = (float) $wallet;
            if($line_total<=$wallet){
                $order = array(
                        'id_security'=>'c0411b4faa415aa5636f3921',
                        'user_id'=>$userid,
                        'total'=>$line_total,
                        'order_date'=>$now,
                        'ip'=>$ip,
                        'order_status'=>'1'
                );
                $order_id = $this->setStepOne(array('order'=>$order));
                if($order_id>0){
                    $core_service_cmf_cart= $this->getServiceManager()
                                                ->get('core_service_cmf_cart');
                    $core_service_cmf_cart->getCart()->emptyCart($userid);
                }else{             
                    throw new \Exception('Fail Order');  
                }
                $setStepTwoa = array('id'=>$order_id,'order_status'=>'2');
                $order_history = array(
                        'orde_id'=>$order_id,
                        'order_status'=>'1',
                        'order_date'=>$now,
                        'ip'=>$ip                
                );
                $this->setStepTwo(array(
                    'setStepTwo'=>$setStepTwoa,
                    'order_history'=>$order_history,
                    'order_item'=>$this->_setItems($allCart, $order_id)));
                
                $payment= array(
                        'method_id'=>'1',
                        'order_id'=>$order_id,
                        'user_id'=>$userid,
                        'total'=>$line_total
                );
                $setStepTwoat = array('id'=>$order_id,'order_status'=>'3');
                $this->setStepThree(array(
                    'payment'=>$payment,
                    'setStepTwo'=> $setStepTwoat));
                $params = array('order'=>$order_id,
                        'total'=>$line_total,
                        'order_date'=>$order['order_date']);
                
            }else{
                throw new \Exception('The wallet is insufficient'); 
            }
        }else{
            throw new \Exception('Cart empty');   
        }
        return $params;
    }
    /**
     * 
     * @param type $allCart
     * @param type $order_id
     * @return type
     */
    private function _setItems($allCart,$order_id){
        $items=array();
        foreach ($allCart as $item) { 
            $items[] = array(
                'order_id'=>$order_id,
                'product_id'=>$item['product_id'],
                'quantity'=>$item['quantity'],
                'price'=>$item['price'],
                'fees'=>$item['fees'],
                'line_total'=>$item['line_total']
                );                    
        }
        return $items;        
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    } 
}