<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cshelperzfcuser\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Cshelperzfcuser\Model\Entity\UserInfo as UserInfo;
use Cshelperzfcuser\Model\Entity\User as User;
use Zend\Db\Adapter\Adapter;
use Zend\Crypt\Password\Bcrypt;
use Mailing\Service\MailerSenderService as MailerSenderService;
use Mailing\Service\MailerService as MailerService;
use Zend\Db\Sql\Sql;

class UserService {

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
     * Return the ZFC user service
     * 
     * @return type
     */
    private function getUserService() {
        return $this->getServiceManager()->get('zfcuser_user_service');
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
	
	public function fetchAll(){
		$mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoProfile');
		
		$userInfos = $mapper->fetchAll();
		return $userInfos;
	}

    public function getUserInfoProfile($userId){
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoProfile');
        $userInfo = $mapper->getUserInfoProfile($userId);

        return $userInfo;
    }
	
    /**
	 * Getting user info profile
	 *
	 * @param Int $userId
	 * @return Entity
     */
	public function getUserInfo($userId) {
		$userInfo = $this->getUserInfoProfile($userId);

		// $userInfo = $mapper->fetchAll();
		return $this->checkProfile($userInfo);
	}

	/**
	 * Checking if the profile is completed
	 *
	 * @param Int $userId
	 * @return Boolean
     */
	public function checkProfile($user) {

        if( $user->getStatus() == -2 ){
            return false;
        }

        return true;
	}

    public function deleteUser($user_id){
        $adapter = $this->getAdapter();
        $sql = new Sql($adapter);

        $update = $sql->update();
        $update->table('user')->set(array("state" => 0))->where(array("user_id" => $user_id));
        $statement = $sql->prepareStatementForSqlObject($update);
        $result    = $statement->execute();

        $update = $sql->update();
        $update->table('user_info')->set(array("status" => 0))->where(array("user_id" => $user_id));
        $statement = $sql->prepareStatementForSqlObject($update);
        $result    = $statement->execute();

        return $result;
    }

    /**
     * Save the user info into user_info's table 
     * 
     * @param array $data
     * @param int $userId
     * @return boolean
     */
    public function updateUserInfo($data, $user_id = null){

        date_default_timezone_set('America/Mexico_City');
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoDao');
        $user_mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $user_data = $user_mapper->getUser($data["user_id"]);
        
        if($user_data->getGid() == 3){
            $parentInfo = $this->getUserInfoProfile($user_id);
        }else{
            $parentInfo = $this->getUserInfoProfile($user_data->getParent());
        }

        if($parentInfo){
            $set_sucursal = $parentInfo->getSucursal();
        }else{
            $set_sucursal = $data["sucursal"];
        }

        $entity = new UserInfo($data);

        $entity->setProfileId($data["user_id"])
               ->setUserId($data["user_id"])
               ->setFullname($data["fullname"])
               ->setPhone($data["phone"])
               ->setCellphone($data["cellphone"])
               ->setEmail($data["email"])
               ->setAddress($data['domicilio'])
               ->setMunicipio($data['municipio'])
               ->setEstado($data["estado"])
               ->setZipCode($data["zipcode"])
               ->setSucursal($set_sucursal)
               ->setBirthdate(strtotime($data["birthdate"]))
               ->setLastUpdate(strtotime(date('d-m-Y')))
               ->setStatus($data["status"]);

        $newEntity = $mapper->saveUser($entity);

        if (null !== $newEntity) {
            if ($newEntity->getProfileId() !== null &&
                    $newEntity->getProfileId() !== 0) {
                return $newEntity;
            }
        }
        return false;
    }

     /**
     * Save the user info into user_info's table 
     * 
     * @param array $data
     * @param int $userId
     * @return boolean
     */
    public function saveUserInfo($data, $user_id, $parent_id = null, $action = null) {
        date_default_timezone_set('America/Mexico_City');
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoDao');
        
        if($action){
            $parentInfo = $this->getUserInfoProfile($parent_id);
            if($parentInfo){
                $set_sucursal = $parentInfo->getSucursal();
            }else{
                $set_sucursal = $data["sucursal"];
            }

            $entity = new UserInfo($data);


            $entity->setUserId($user_id)
                   ->setFullname(strtoupper($data['fullname']))
                   ->setPhone($data['phone'])
                   ->setCellphone($data['cellphone'])
                   ->setEmail($data['email'])
                   ->setAddress($data['domicilio'])
                   ->setMunicipio($data['municipio'])
                   ->setEstado($data["estado"])
                   ->setZipCode($data["zipcode"])
                   ->setSucursal($set_sucursal)
                   ->setBirthdate(strtotime($data['birthdate']))
                   ->setLastUpdate(strtotime(date('d-m-Y')))
                   ->setStatus(-2);

            $newEntity = $mapper->createUser($entity);
            
        }else{
            $parent = $this->getParent($user_id)->getUserId();
            $parentInfo = $this->getUserInfoProfile($parent);

            if($parentInfo){
                $set_sucursal = $parentInfo->getSucursal();
            }else{
                $set_sucursal = $data["sucursal"];
            }

            $entity = new UserInfo($data);
            $entity->setProfileId($entity->getProfileId())
                   ->setUserId($user_id)
                   ->setFullname($data['fullname'])
                   ->setPhone($data['phone'])
                   ->setCellphone($data['cellphone'])
                   ->setEmail($data['email'])
                   ->setAddress($data['domicilio'])
                   ->setMunicipio($data['municipio'])
                   ->setEstado($data["estado"])
                   ->setZipCode($data["zipcode"])
                   ->setSucursal($parentInfo->getSucursal())
                   ->setBirthdate(strtotime($data['birthdate']))
                   ->setLastUpdate(strtotime(date('d-m-Y')))
                   ->setStatus(1);

            $newEntity = $mapper->saveUser($entity);
        }
        
        if (null !== $newEntity) {
            if ($newEntity->getProfileId() !== null &&
                    $newEntity->getProfileId() !== 0) {
                return $newEntity;
            }
        }
        return false;
    }

    /**
     * Create user in system
     * 
     * @param Array $data
     * @param Int $user_id | ref. parentId
     *
     * @return Int
     */
    public function createUser($data, $user_id){
        
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
	    $registro_service = $this->getServiceManager()->get('registro_service');
        
        //si username está vacío, generar uno aleatoriamente
        if(empty($data["username"])){
            $username_array = explode(" ", $data["fullname"]);

            $chars  = "0123456789";
            $random = substr( str_shuffle( $chars ), 0, 5 );
            $username = $registro_service->generateUsername($username_array[0]); //strtoupper($username_array[0]).$random;
        }else{
            $username = $data["username"];
        }

        if(empty($data["password"])){
            $string_pass = $this->randomString(10);
        }else{
            $string_pass = $data["password"];
        }

        $UserService = $this->getUserService();

        $user_entity = new User();
        $user_entity->setEmail($data["email"])
                    ->setDisplayName(strtoupper($data["fullname"]))
                    ->setPassword($UserService->getFormHydrator()->getCryptoService()->create($string_pass))
                    ->setState(1)
                    ->setGid($data["perfil"])
                    ->setParent($user_id)
                    ->setUsername($username);

        $exists = $mapper->exists($username);
        
        if(!$exists){
            //insert into user table
            // $user_inserted = $mapper->insert($user_entity);

            if ($user_inserted !== null) {
                $subject = "Bienvenido a Brilla con Tecnolite.";
    
                $mailer  = new MailerService();
                $content = new MailerSenderService();
            
                $mailer->setSubject($subject);
                $mailer->setTo($user_inserted->getEmail());

                $body = $content->getEmailContentRecovery($user_inserted, $string_pass);

                $mailer->setBody($body);
                $mailer->send();

                // $mail_sender = $this->getServiceManager()->get('mailer_sender_service');
                // $mail_sender->sendMailPreRegister($user_inserted, $string_pass);
                $user_inserted = $user_entity->getUserId();
            }

            // echo "<pre>";
            // var_dump($data);
            // var_dump($user_inserted);
            // var_dump($user_id);
            // echo "</pre>";
            // die;

            //insert into user_info table
            $user_saved = $this->saveUserInfo($data, $user_inserted, $user_id, "insert");

			// Saving in user_control table
	        $user_report = array(
	            "user_id" => $user_inserted,
	            "password_text" => $string_pass,
	            "profile" => $data["perfil"]
	        );
            $registro_service->saveControl($user_report);

            if($user_entity->getGid() == 2){
                $registro_service->generateCuotas($user_inserted);
            }

            if($user_entity->getGid() == 3){
                $registro_service->generateDataLoaded($user_inserted);
            }
            
			return $user_saved;
        }

        return false;
    }

    public function getUser($user_id){
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $user   = $mapper->getUser($user_id);

        return $user;
    }

    public function getUsersByParent($user_id){
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $users   = $mapper->getUsersByParent($user_id);

        $ids = array();

        foreach ($users as $user) {
            array_push($ids,  $user['user_id']);
        }

            // $ids_string = implode(',', $ids);
            // $ids_count  = count($ids);
        return $ids;
    }

    public function getParent($user_id){
        $local_user  = $this->getUser($user_id);
        $parent_user = $this->getUser($local_user->getParent());

        return $parent_user;
    }

	public function getSelectOptions(){
		// $dbAdapter = $this->getAdapter();
        // $sql       = 'SELECT t0.estado_id, t0.nombre FROM cat_estados t0 ORDER BY t0.nombre ASC';
        // $statement = $dbAdapter->query($sql);
        // $result    = $statement->execute();
     
        // $selectData = array();
     
        // foreach ($result as $res) {
        //  $selectData[$res['estado_id']] = $res['nombre'];
        // }
     
        // return $selectData;
	}

    public function randomString($length) {
        $randomString = '';
        $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $char_lngth = 36;

        for($i = 0 ; $i < $length ; $i++) {
            $randomString .= $chars[mt_rand(0,$char_lngth-1)];
        }
        
        return $randomString;
    }

}
