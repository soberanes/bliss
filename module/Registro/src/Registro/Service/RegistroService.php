<?php
namespace Registro\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Parameters;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Mailing\Service\MailerSenderService as MailerSenderService;
use Mailing\Service\MailerService as MailerService;

class RegistroService implements ServiceManagerAwareInterface
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

    public function guardaEncargado($data, $i){
        date_default_timezone_set('America/Mexico_City');
        $user_service = $this->getServiceManager()->get('zfcuser_user_service');
        $adapter = $this->getAdapter();

        $sql = new Sql($adapter);

        // Creating username
        echo $username = $this->generateUsername($data[1]);
        
        // Creating password
        $string_pass = $this->randomString(8);

        $password = $user_service->getFormHydrator()->getCryptoService()->create($string_pass);
        // echo "<pre>";
        // var_dump($password);
        // echo "</pre>";
        // die;

        // Saving in user table
        $new_data = array(
            "username"     => $username,
            "email"        => $data[2],
            "display_name" => $data[1],
            "password"     => $password,
            "state"        => 1,
            "gid"          => 4,
            "parent"       => 0,
        );

        $insert_user = $sql->insert('user');
        $insert_user->values($new_data);

        $statement1 = $sql->prepareStatementForSqlObject($insert_user);
        $resultSet1 = $statement1->execute();
        $user_id = $adapter->getDriver()->getLastGeneratedValue();
        
        // Saving in user_control table
        $user_report = array(
            "user_id" => $user_id,
            "password_text" => $string_pass,
            "profile" => 3
        );
        
        $this->saveControl($user_report);

        //Saving in user_info
        $user_info = array(
            "user_id"     => $user_id,
            "comercial"   => NULL,
            "rfc"         => NULL,
            "address"     => NULL,
            "fullname"    => $data[1],
            "email"       => $data[2],
            "phone"       => NULL,
            "birthdate"   => NULL,
            "sucursal"    => $data[3],
            "last_update" => time(),
            "status"      => -2
        );

        $insert_user_info = $sql->insert('user_info');
        $insert_user_info->values($user_info);

        $statement3 = $sql->prepareStatementForSqlObject($insert_user_info);
        $resultSet3 = $statement3->execute();
        $user_info_id = $adapter->getDriver()->getLastGeneratedValue();
        return $user_info_id;
    }
    
    public function saveControl($data){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        
        $user_report = array(
            "user_id" => $data["user_id"],
            "password_text" => $data["password_text"],
            "profile" => $data["profile"]
        );
        
        $insert_user_control = $sql->insert('user_control');
        $insert_user_control->values($user_report);

        $statement2 = $sql->prepareStatementForSqlObject($insert_user_control);
        $resultSet2 = $statement2->execute();
        
    }

    public function getFamilias(){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $select = $sql->select();
        $select->from('familias');
        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        return $resultSet;
    }

	public function generateCuotas($user){
		$adapter = $this->getAdapter();
		$sql = new Sql($adapter);
		
        $familias = $this->getFamilias();
        foreach ($familias as $familia) {
            
            $table = ($familia["avg_puntos"]) ? "user_cuota_f" : "user_cuota_a";

            for($i=0;$i<12;$i++){

                $data = array(
                    "usuario_id" => $user,
                    "familia_id" => $familia["familia_id"],
                    "cuota"      => 0,
                    "mes"        => $i+1
                );

                unset($insert_cuota);
                unset($statement);
                unset($resultSet);

                $insert_cuota = $sql->insert($table);
                $insert_cuota->values($data);

                $statement = $sql->prepareStatementForSqlObject($insert_cuota);
                $resultSet = $statement->execute();
            }
        }
	}

    public function generateDataLoaded($user){
        date_default_timezone_set("America/Mexico_City");
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);
        $table = "data_loaded";

        for($i=0;$i<12;$i++){
            $data = array(
                "user_id" => $user,
                "archivo_id" => 0,
                "month" => $i+1,
                "process_date" => time(),
                "status" => 2
            );

            unset($insert);
            unset($statement);
            unset($resultSet);

            $insert = $sql->insert($table);
            $insert->values($data);

            $statement = $sql->prepareStatementForSqlObject($insert);
            $resultSet = $statement->execute();
        }
    }
	
	public function generateUsername($fullname){
		$user_addon = $this->randomString(2, true);
        $username = strtolower(str_replace(" ", "",substr($fullname,0,8) . $user_addon));
		return $username;
	}
    
    public function randomString($length, $numeric = null) {
        $randomString = '';

        if($numeric){
            $chars = '1234567890';
            $char_lngth = 10;
        }else{
            $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            $char_lngth = 36;
        }


        for($i = 0 ; $i < $length ; $i++) {
            $randomString .= $chars[mt_rand(0,$char_lngth-1)];
        }
        
        return $randomString;
    }




}