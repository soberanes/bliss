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
use Cscore\Model\Entity\Credits as Credits;

class CreditsTable extends AbstractTableGateway {

    /**
     * nombre de tabla
     * @var type 
     */
    protected $table = 'credits';

    /**
     * Constructor
     * 
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * Lista Todos los Items
     * 
     * @return type
     */
    public function fetchAll() {
        $resultSet = $this->select(function (Select $select) {
            $select->order('id ASC');
        });

        $entities = array();
        foreach ($resultSet as $row) {
            $entity = new Credits();
            $entity->setId($row->id);
            $entity->setUserid($row->user_id);
            $entity->setCredit($row->credit);
            $entity->setLastupdate($row->last_update);
            $map = array(
                'id' => $entity->getId(),
                'user_id' => $entity->getUserid(),
                'credit' => $entity->getCredit(),
                'last_update' => $entity->getLastupdate()
            );
            $entities[] = $map;
        }
        return $entities;
    }

    /**
     * Busca un Especifico ID
     * 
     * @param type $id
     * @return type
     */
    public function findId($id) {
        $resultSet = $this->select(function (Select $select) use ($id) {
            $select->where(array('user_id' => $id));
        });
        $entity = new Credits();
        $row = $resultSet->current();
        if (!$row) {
            $entity->setId('');
            $entity->setUserid('');
            $entity->setCredit('');
            $entity->setLastupdate('');
        } else {
            $entity->setId($row->id);
            $entity->setUserid($row->user_id);
            $entity->setCredit($row->credit);
            $entity->setLastupdate($row->last_update);
        }

        $entities = array(
            'id' => $entity->getId(),
            'user_id' => $entity->getUserid(),
            'credit' => $entity->getCredit(),
            'last_update' => $entity->getLastupdate()
        );

        return $entities;
    }

    /**
     * Actualiza el total de creditos
     * 
     * @param type $userid
     * @param type $total
     * @return boolean
     */
    public function setPayments($userid, $total) {
        $isPayment = false;
        $resultSet = $this->select(function (Select $select) use ($userid) {
            $select->where(array('user_id' => $userid));
        });
        if ($resultSet->count() > 0) {
            $row = $resultSet->current();
            $entity = $this->setEntity($row);
            $entities = $this->getEntities($entity);
            if ($total > $entities['credit']) {
                $newtotal = 0;
            } else {
                $newtotal = $entities['credit'] - $total;
                $isPayment = true;
            }
            $this->update(array('credit' => $newtotal), array('user_id' => $userid));
        }
        return $isPayment;
    }

    /**
     * Abona una cantidad al total de creditos
     * 
     * @param type $userid
     * @param type $total
     * @return boolean
     */
    public function addCredit($userid, $total) {
        $row = $this->select(function (Select $select) use ($userid) {
                    $select->where(array('user_id' => $userid));
                })->current();
        if ($row) {
            $entity = $this->setEntity($row);
            $entities = $this->getEntities($entity);
            $newtotal = $entities['credit'] + $total;
            $this->update(array('credit' => $newtotal), array('user_id' => $userid));
            return true;
        } else {
            $this->insert(array('user_id' => $userid, 'credit' => $total, 'last_update' => time()));
            return true;
        }
        return false;
    }

    /**
     * Setea Entidades
     * 
     * @param type $row
     * @return \Cscore\Model\Entity\Credits
     */
    public function setEntity($row) {
        $entity = new Credits();
        $entity->setId($row->id);
        $entity->setUserid($row->user_id);
        $entity->setCredit($row->credit);
        $entity->setLastupdate($row->last_update);
        return $entity;
    }

    /**
     * Obtiene tipos de datos para entidades
     * 
     * @param \Cscore\Model\Entity\Credits $entity
     * @return type
     */
    public function getEntities(Credits $entity) {
        $entities = array(
            'id' => $entity->getId(),
            'user_id' => $entity->getUserid(),
            'credit' => $entity->getCredit(),
            'last_update' => $entity->getLastupdate()
        );
        return $entities;
    }

}
