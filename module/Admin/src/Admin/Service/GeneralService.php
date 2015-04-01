<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Admin\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\Container;
use Zend\Validator\File\Size;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class GeneralService implements ServiceManagerAwareInterface {

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var adapter
     */
    protected $adapter;

    /**
     * Set the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Uploader\Service\ProcessFile
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    /**
     * Get Adapter
     * 
     * @return type
     */
    public function getAdapter() {
        if (!$this->adapter) {
            $sm = $this->getServiceManager();
            $this->adapter = $sm->get('db');
        }
        return $this->adapter;
    }

    public function getUserControl(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from('user_control')
               ->join('user', 'user.user_id = user_control.user_id')
               ->join('roles', 'roles.id = user.gid')
               ->join('user_info', 'user_info.user_id = user_control.user_id')
               ->order('user_control.user_id');
        echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    public function getEncargados(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from('user')
               ->join('user_info', 'user_info.user_id = user.user_id')
               ->join('sucursales', 'sucursales.sucursal_id = user_info.sucursal')
               ->where(array(
                    'gid' => 3
                ))
               ->order('sucursales.distribuidor');
        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    public function processFile($data, $filename){
        $mecanica_aplicaciones = $this->getServiceManager()->get('mecanica_aplicaciones');
        return $mecanica_aplicaciones->processFile($data, $filename);
    }

}