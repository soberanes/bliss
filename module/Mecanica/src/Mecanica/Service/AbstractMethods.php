<?php

namespace Mecanica\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class AbstractMethods {

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

    /**
     * Get family by product
     * 
     * @param int $product
     * @return type
     */
	public function getProductFamily($sku){
		$adapter = $this->getAdapter();

    	$sql = new Sql($adapter);
    	$select = $sql->select();
    	$select->from('products')
    		   ->columns(array('familia_id'))
    		   ->where(array(
    		   		'sku' => $sku,
    		   		'status' => 1
    		   	));
    	$statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $familia = $resultSet->current();
        return $familia;
	}

    /**
     * Get product by fullname
     * 
     * @param int $product
     * @return type
     */
    public function getProduct($sku){
        $adapter = $this->getAdapter();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('products')
               ->where(array(
                    'sku' => $sku
                ));
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $product = $resultSet->current();
        return $product;
    }

    /**
     * Get product count
     * 
     * @return int
     */
    public function getProductCount(){
        $adapter = $this->getAdapter();

        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('products')
               ->columns(array('count' => new Expression('COUNT(*)')));

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $count = $resultSet->current();
        return $count["count"];
    }

    /**
     * Get apps count
     * 
     * @return int
     */
	public function getAppsCount(){
		$adapter = $this->getAdapter();

    	$sql = new Sql($adapter);
    	$select = $sql->select();
    	$select->from('applications')
    	       ->columns(array('count' => new Expression('COUNT(*)')));

    	$statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $count = $resultSet->current();
        return $count["count"];
	}

	/**
	 * Get user by fullname
	 * 
	 * @param int $fullname
	 * @return entity
	 */
	public function getUserByFullname($fullname){
		$mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoProfile');
		$user   = $mapper->getUserByFullname($fullname);

        return $user;
	}

	/**
	 * Get user by fullname
	 * 
	 * @param int $fullname
	 * @return entity
	 */
	public function getCuota($usuario, $mes, $familia){
	 	$cuotasTable = $this->getServiceManager()->get('cuotas_table');
	 	$cuota = $cuotasTable->getCuota($usuario, $mes, $familia);
	 	return $cuota;
	}

	/**
     * Get loaded file sheet's data
     * 
     * @param string $inputFile
     * @return type Array
     */
    protected function getFileData($inputFile){
        $inputFileLocation = '.'.$inputFile;
        $objPHPExcel = \PHPExcel_IOFactory::load($inputFileLocation);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        
        return $sheetData;
        
    }

	/**
     * Get loaded file sheet's data
     * 
     * @param string $inputFile
     * @return type Array
     */
	public function setPuntos($data){
		$puntuacion_srv = $this->getServiceManager()->get('puntuacion_service');
		$puntuacion = $puntuacion_srv->setPuntosToUser($data);
	}

    public function setCredit($user, $month){
        $userProfileService = $this->getServiceManager()->get('user_profile_service');
        $creditsTable = $this->getServiceManager()->get('Cscore\Model\CreditsTable');
        $user_ids = $userProfileService->getUsersByParent($user);
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        //set vendedores crédit
        $select = $sql->select();
        $select->from('puntuacion')
               ->where(array("user_id" => $user_ids, "mes" => $month));
        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();

        foreach ($result as $puntuacion) {
            // $credit = $creditsTable->findId($puntuacion["user_id"]);
            $abono_v = $creditsTable->addCredit($puntuacion["user_id"], $puntuacion["puntos"]);

            //var_dump($credit["credit"]);die;
            //get credit by user ["user_id"]
            //update credit (credit + ["puntos"])
        }

        //set encargado crédit
        $select = $sql->select();
        $select->from('puntuacion_encargados')
               ->where(array("user_id" => $user, "mes" => $month));
        $statement    = $sql->prepareStatementForSqlObject($select);
        $puntuacion_e = $statement->execute()->current();
        
        $abono_e = $creditsTable->addCredit($puntuacion_e["user_id"], $puntuacion_e["puntos"]);
        return $abono_e;
    }

	public function setPuntosEncargado($data){
		date_default_timezone_set('America/Mexico_City');
		$uploader_srv   = $this->getServiceManager()->get('uploader_service');
        $puntuacion_service = $this->getServiceManager()->get('puntuacion_service');

        $puntos = 0;

        if($data['day'] <= 5){
        	$puntos = 50;
        }

        $data["puntos"] = $puntos + $data['plus'];

        $puntuacion = $puntuacion_service->setPuntosToParent($data);

		//marcar como check el proceso de carga de archivo. status 3
        return $uploader_srv->checkLoadSuccess($data);
	}

	public function getPlus($parent, $month){
		$userProfileService = $this->getServiceManager()->get('user_profile_service');
		$user_ids = $userProfileService->getUsersByParent($parent);
		$adapter = $this->getAdapter();
		$sql = new Sql($adapter);

        //$user_ids_str = implode(',', $userProfileService->getUsersByParent($parent));

        $total_count = count($user_ids);
        $reference   = 0;

        foreach ($user_ids as $user_id) {

            $select = $sql->select();
            $select->from('puntuacion')
                   ->columns(array('total' => new Expression('sum(puntuacion.puntos)')))
                   ->join('user_cuota_f', 'user_cuota_f.cuota_id = puntuacion.cuota')
                   ->where(array(
                        'puntuacion.user_id' => $user_id,
                        'puntuacion.mes' => $month
                    ));

            $statement = $sql->prepareStatementForSqlObject($select);
            $result    = $statement->execute()->current();
            
            if($result["total"] > 50){
                $reference++;
            }else{
                continue;
            }
        }

        if($reference == $total_count){
            return true;
        }

        return false;
        
	}

    public function getAvgFamily($family){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $select = $sql->select();
        $select->from('familias')
               ->where(array("familia_id" => $family));

        $statement = $sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute()->current();

        return $result["avg_puntos"];
    }

    public function _predump($arg){
        // echo "<pre>";
        var_dump($arg);
        // echo "</1pre>";
        die;
    }

}
