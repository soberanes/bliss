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

    /**
     * Save the user info into user_info's table 
     * 
     * @param array $data
     * @param int $userId
     * @return boolean
     */
    public function updateUserInfo($data, $user_id, $status = -1, $gid){
        date_default_timezone_set('America/Mexico_City');
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\UserInfoDao');
        $user_mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
        $user_data = $user_mapper->getUser($user_id);
		
		
		if($gid == 3){
			$parentInfo = $this->getUserInfoProfile($user_id);
		}else{
	        $parentInfo = $this->getUserInfoProfile($user_data->getParent());
		}
	        $entity = new UserInfo($data);
	
	        $entity->setProfileId($user_id)
	               ->setUserId($user_id)
	               ->setComercial($data->comercial)
	               ->setRfc($data->rfc)
	               ->setAddress($data->address)
	               ->setFullname($data->fullname)
	               ->setPhone($data->phone)
	               ->setCellphone($data->cellphone)
	               ->setEmail($data->email)
	               ->setSucursal($parentInfo->getSucursal())
	               ->setBirthdate(strtotime($data->birthdate))
	               ->setLastUpdate(strtotime(date('d-m-Y')))
	               ->setStatus($status);

        $newEntity = $mapper->saveUser($entity);
        if (null !== $newEntity) {
            if ($newEntity->getProfileId() !== null &&
                    $newEntity->getProfileId() !== 0) {
                return true;
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

            $entity = new UserInfo($data);
            $entity->setProfileId($user_id)
                   ->setUserId($user_id)
                   ->setFullname($data['fullname'])
                   ->setPhone($data['phone'])
                   ->setCellphone($data['cellphone'])
                   ->setEmail($data['email'])
                   ->setSucursal($parentInfo->getSucursal())
                   ->setBirthdate(strtotime($data['birthdate']))
                   ->setLastUpdate(strtotime(date('d-m-Y')))
                   ->setStatus(-2);

            $newEntity = $mapper->createUser($entity);
        }else{
            $parent = $this->getParent($user_id)->getUserId();
            $parentInfo = $this->getUserInfoProfile($parent);
            
            $entity = new UserInfo($data);
            $entity->setProfileId($user_id)
                   ->setUserId($user_id)
                   ->setFullname($data['fullname'])
                   ->setPhone($data['phone'])
                   ->setCellphone($data['cellphone'])
                   ->setEmail($data['email'])
                   ->setSucursal($parentInfo->getSucursal())
                   ->setBirthdate(strtotime($data['birthdate']))
                   ->setLastUpdate(strtotime(date('d-m-Y')))
                   ->setStatus(1);

            $newEntity = $mapper->saveUser($entity);
        }
        
        if (null !== $newEntity) {
            if ($newEntity->getProfileId() !== null &&
                    $newEntity->getProfileId() !== 0) {
                return true;
            }
        }
        return false;
    }

    public function createUser($data, $user_id){
        
        $mapper = $this->getServiceManager()->get('Cshelperzfcuser\Model\Mapper\User');
	    $registro_service = $this->getServiceManager()->get('registro_service');
        
        $username_array = explode(" ", $data["fullname"]);

        $chars  = "0123456789";
        $random = substr( str_shuffle( $chars ), 0, 5 );
        $username = $registro_service->generateUsername($username_array[0]); //strtoupper($username_array[0]).$random;

        // $username = 'demo';
        $string_pass = $this->randomString(10);
        $UserService = $this->getUserService();

        $user_entity = new User();
        $user_entity->setEmail($data->email)
                    ->setDisplayName($data->fullname)
                    ->setPassword($UserService->getFormHydrator()->getCryptoService()->create($string_pass))
                    ->setState(1)
                    ->setGid(2)
                    ->setParent($user_id)
                    ->setUsername($username);

        $exists = $mapper->exists($username);
        
        if(!$exists){
            //insert into user table
            $user_inserted = $mapper->insert($user_entity);


            if ($user_inserted !== null && false !== $user_inserted) {
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

            //insert into user_info table
            $user_saved = $this->saveUserInfo($data, $user_inserted, $user_id, "insert");
			
			// Saving in user_control table
	        $user_report = array(
	            "user_id" => $user_inserted,
	            "password_text" => $string_pass,
	            "profile" => 2
	        );
	        
	        $registro_service->saveControl($user_report);
            $registro_service->generateCuotas($user_inserted);

			
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
