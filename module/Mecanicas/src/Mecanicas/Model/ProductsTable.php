<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */

namespace Mecanicas\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select as Select;
use Zend\Db\Sql\Where;
use Zend\Db\Sql\Expression;

class ProductsTable extends AbstractTableGateway {
	/**
     * nombre de tabla 
     * @var type 
     */
    // protected $prodGlobalTable = 'productos_globales';
    // protected $prodDistTable   = 'productos_distribuidor';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function searchProduct($distribuidor, $concepto){
    	
    	$dist_product = $this->getDistProduct($distribuidor, $concepto["descripcion"]);
    	if(!$dist_product){
    		return false;
    	}
    	$global_product = $this->getGlobalProduct($dist_product->producto_global_id);

    	return $global_product;

    }

    public function getDistProduct($distribuidor, $descripcion){
    	
    	$prodDistTable = new TableGateway('productos_distribuidor', $this->adapter);
		$rowset = $prodDistTable->select(array(
    			'distribuidor_id' => $distribuidor,
    			'descripcion_distribuidor' => $descripcion,
    			'estatus' => 1
    		));
		$prodDist = $rowset->current();
		return $prodDist;
    }

    public function getGlobalProduct($producto){
    	
    	$prodDistTable = new TableGateway('productos_globales', $this->adapter);
		$rowset = $prodDistTable->select(array(
    			'productos_globales_id' => $producto,
    			'estatus' => 1
    		));
		$prodDist = $rowset->current();
		return $prodDist;
    }

}

