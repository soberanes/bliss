<?php

namespace HistorialCanjes\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
       
        $historial = array();
        
        $user = $this->getBasicInfoService();
        
        // obtener las ordenes del usuario
        $order_check_table = $this->getServiceLocator()->get('Application\Model\OrdercheckTable');
        $orders = $order_check_table->findAllById(array(
            'where'=>array('user_id'=>$user['id']),
            'order'=>'id ASC'
        ));
        
        // por cada orden, obtener sus productos
        $order_item_table = $this->getServiceLocator()->get('Application\Model\OrderitemTable');
        $product_table = $this->getServiceLocator()->get('Application\Model\ProductTable');
        foreach($orders as $order){
            $items = $order_item_table->findAllById(array(
                'where'=>array('order_id'=>$order['id']),
                'order'=>'id ASC'
            ));
            $products = array();
            foreach($items as $item){
                $product = $product_table->fetchOneById(array(
                    'where'=>array('id'=>$item['product_id']),
                    'order'=>'id ASC'
                ));  
                $product['quantity'] = $item['quantity'];
                $product['price'] = $item['price'];   
                $product['line_total'] = $item['line_total'];   
                $products[] = $product;
            }
            $order['products'] = $products;
            $historial[] = $order;
        }
        
        $arrayAdapter = new \Zend\Paginator\Adapter\ArrayAdapter($historial);
        $paginator = new \Zend\Paginator\Paginator($arrayAdapter);
        $page = $this->getEvent()->getRouteMatch()->getParam('page');
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(2);
        return new ViewModel(array('orders'=>$paginator));
    }
    
    public function getBasicInfoService(){
        $core_service_cmf_user = $this->getServiceLocator()
                ->get('core_service_cmf_user');
        $arrUSerinfo = $core_service_cmf_user->getUser()->getBasicInfo();
        return $arrUSerinfo;
    }


}

