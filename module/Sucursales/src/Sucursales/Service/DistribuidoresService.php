<?php
namespace Sucursales\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Parameters;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class DistribuidoresService implements ServiceManagerAwareInterface
{
	/**
     * @var ServiceManager
     */
    protected $serviceManager;
    protected $adapter;

    /**
     * Get Service Manager
     * 
     * @return type
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Inject Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * Inject Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return Service
     */
    public function get($param) {
        return $this->getServiceManager()->get($param);
    }

    /**
     * Get Adapter
     * 
     * @return type
     */
    public function getAdapter(){
        if(!$this->adapter){
            $sm = $this->getServiceManager();
            $this->adapter = $sm->get('db');
        }
        return $this->adapter;
    }
    
    public function getDistribuidores(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('distribuidores');
        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }

    public function saveDistribuidor($data, $action = null){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $dist_nombre = strtoupper($data["nombre"]);

        $new_data = array(
            // "sucursal_id"  => $data["sucursal_id"],
            "nombre"       => $dist_nombre,
        );

        if($action == "update"){
            $update = $sql->update();
            $update->table('distribuidores')->set($new_data)->where(array('distribuidor_id' => $data['distribuidor_id']));
            $statement = $sql->prepareStatementForSqlObject($update);
        }else{
            $insert_user = $sql->insert('distribuidores');
            $insert_user->values($new_data);
            $statement  = $sql->prepareStatementForSqlObject($insert_user);
        }
        
        $resultSet  = $statement->execute();
        $sucursal_id = $adapter->getDriver()->getLastGeneratedValue();
        return $sucursal_id;
    }

    public function getDistribuidor($distribuidor_id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('distribuidores')
               ->where(array('distribuidor_id' => $distribuidor_id));

        $statement = $sql->prepareStatementForSqlObject($select);
        return (object)$resultSet = $statement->execute()->current();
    }

    public function deleteDistribuidor($distribuidor_id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $delete = $sql->delete();
        $delete->from('distribuidores')->where(array('distribuidor_id' => $distribuidor_id));
        $statement = $sql->prepareStatementForSqlObject($delete);
        $resultSet = $statement->execute();
    }


}