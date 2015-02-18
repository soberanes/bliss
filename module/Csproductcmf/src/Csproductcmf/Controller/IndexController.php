<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Csproductcmf\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $matches = $this->getEvent()->getRouteMatch();
        $page = $matches->getParam('page', 1);
        $cat = (int) $matches->getParam('cat', 1);
        $csproductcmf_product = $this->getServiceLocator()
                ->get('core_service_cmf_product');
        $allProducts = $csproductcmf_product->getProduct()->getAllProducts($page, $cat);

        $cscategorycmf_category = $this->getServiceLocator()
                ->get('core_service_cmf_category');
        $category = $cscategorycmf_category->getCategory()->getCategoriebyid($cat);
	    
        return new ViewModel(array(
        	'sample' => $allProducts,
            'cat' => $cat,
            'page' => $page,
            'catname' => $category["name"]
        ));
    }

    public function productoAction() {
        $matches = $this->getEvent()->getRouteMatch();
        $id = (int) $matches->getParam('id', 1);
        $csproductcmf_product = $this->getServiceLocator()
                ->get('core_service_cmf_product');
        $Products = $csproductcmf_product->getProduct()->getProductoById($id);

        $categories = $csproductcmf_product->getProduct()->getCategoriebyid($id);
        $cscategorycmf_category = $this->getServiceLocator()
                ->get('core_service_cmf_category');

        $categoria = $cscategorycmf_category->getCategory()->getCategoriebyid($categories['category_id']);
        $isCanjeOpen = $this->isCanjeOpen();
        return new ViewModel(array('producto' => $Products,
            'categoria' => $categoria['name'], 'isCanjeOpen' => $isCanjeOpen));
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
