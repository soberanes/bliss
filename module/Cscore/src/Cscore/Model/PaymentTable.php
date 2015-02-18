<?php
/**
 * CookieShop
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 * @author Ing. Eduardo Ortiz <eduardooa1980@gmail.com>
 */
namespace Cscore\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;
use Cscore\Model\Entity\Payment as Payment;
class PaymentTable extends AbstractTableGateway{
    /**
     *  nombre de tabla
     * @var type 
     */
    protected $table  = 'payment';
    
    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }   
    
    /**
     * Lista todos los Items
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
                    $select->order('id ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }
    
    /**
     * Lista todos los Items Relacionados por ID
     * 
     * @param type $id
     * @return type
     */
    public function findAllById($id) {
        $resultSet = $this->select(function (Select $select) use($id){
                    $select->where(array('id'=>$id));
                    $select->order('id ASC');
                });
        $entities = array();
        foreach ($resultSet as $row) { 
            $entity = $this->setEntity($row);
            $entities[] = $this->getEntities($entity);
        }
        return $entities;
    }    
    /**
     * Lista un Item Relacionado a un ID
     * 
     * @param type $id
     * @return type
     */
    public function fetchOneById($id) {
        $resultSet = $this->select(function (Select $select) use($id){
                    $select->where(array('id'=>$id));
                    $select->order('id ASC');
                });
        $entities = array();
        if(count($resultSet)===1){
            $row = $resultSet->current();
            $entity = $this->setEntity($row);
            $entities = $this->getEntities($entity);             
        }
        return $entities;
    }
    
    /**
     * Inserta Items
     * @param type $params
     */
    public function insertPayment($params){
        $entity = new Payment();
        $entity->setMethodid($params['payment']['method_id']);
        $entity->setOrderid($params['payment']['order_id']);
        $entity->setUserid($params['payment']['user_id']);
        $entity->setTotal($params['payment']['total']); 
        $data = $this->getEntities($entity);
        $this->insert($data);
    }
    
    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Payment
     */
    public function setEntity($row){
        $entity = new Payment();
        $entity->setId($row->id);
        $entity->setMethodid($row->method_id);
        $entity->setOrderid($row->order_id);
        $entity->setUserid($row->user_id);
        $entity->setTotal($row->total);
        
        return $entity;
    }
    
    /**
     * Obtiene tipos de datos a entidades
     * 
     * @param \Cscore\Model\Entity\Payment $entity
     * @return type
     */
    public function getEntities(Payment $entity){
        $entities= array(
            'id'=>$entity->getId(),
            'method_id'=>$entity->getMethodid(),
            'order_id'=>$entity->getOrderid(),
            'user_id'=>$entity->getUserid(),
            'total'=>$entity->getTotal()
        ); 
        return $entities;
    }
}
