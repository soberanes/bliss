<?php
namespace Sucursales\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Parameters;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class SucursalesService implements ServiceManagerAwareInterface
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

    public function getSucursales(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('sucursales')
               ->join('distribuidores', 
                      'distribuidores.distribuidor_id = sucursales.distribuidor', 
                      array('nombre_dist' => 'nombre'))
               ->order('sucursales.distribuidor');
        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return $resultSet = $statement->execute();
    }



    public function getSucursal($sucursal_id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('sucursales')
               ->where(array('sucursal_id' => $sucursal_id));
        // echo $sql->getSqlstringForSqlObject($select);die;

        $statement = $sql->prepareStatementForSqlObject($select);
        return (object)$resultSet = $statement->execute()->current();
    }

    public function saveSucursal($data, $sucursal_id = null){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $sucursal_nombre = strtoupper($data["nombre"]);

        $new_data = array(
            "nombre"       => $sucursal_nombre,
            "distribuidor" => $data["distribuidor"]
        );

        if($sucursal_id){
            $update = $sql->update();
            $update->table('sucursales')->set($new_data)->where(array('sucursal_id' => $sucursal_id));
            $statement = $sql->prepareStatementForSqlObject($update);
            $result    = $statement->execute();
        }else{
            $insert_user = $sql->insert('sucursales');
            $insert_user->values($new_data);
            $statement1  = $sql->prepareStatementForSqlObject($insert_user);
        }
        
        $resultSet1  = $statement1->execute();
        $sucursal_id = $adapter->getDriver()->getLastGeneratedValue();
        return $sucursal_id;
    }

    public function getOptionsForSelect($table){

        $dbAdapter = $this->getAdapter();

        if($table == "distribuidores"){
            $sql = 'SELECT t0.distribuidor_id as id, t0.nombre as name FROM '.$table.' t0 ORDER BY t0.nombre ASC';
        }else{
            $sql = 'SELECT t0.sucursal_id as id, t0.nombre as name FROM '.$table.' t0 ORDER BY t0.nombre ASC';
        }

        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['name'];
        }

        return $selectData;
    }

}