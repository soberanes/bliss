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
        $user_addon = $this->randomString(2, true);
        $username = strtolower(str_replace(" ", "",substr($data["fullname"],0,8) . $user_addon));

        // Creating password
        $string_pass = $this->randomString(8);
        $password = $user_service->getFormHydrator()->getCryptoService()->create($string_pass);

        // Saving in user table
        $new_data = array(
            "username"     => $username,
            "email"        => $data["email"],
            "display_name" => $data["fullname"],
            "password"     => $password,
            "state"        => 1,
            "gid"          => 3,
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
            "password_text" => $string_pass
        );
        
        $insert_user_control = $sql->insert('user_control');
        $insert_user_control->values($user_report);

        $statement2 = $sql->prepareStatementForSqlObject($insert_user_control);
        $resultSet2 = $statement2->execute();

        //Saving in user_info
        $user_info = array(
            "user_id"     => $user_id,
            "comercial"   => NULL,
            "rfc"         => NULL,
            "address"     => NULL,
            "fullname"    => NULL,
            "email"       => $data["email"],
            "phone"       => NULL,
            "birthdate"   => NULL,
            "sucursal"    => $data["sucursal"],
            "last_update" => time(),
            "status"      => -2
        );

        $insert_user_info = $sql->insert('user_info');
        $insert_user_info->values($user_info);

        $statement3 = $sql->prepareStatementForSqlObject($insert_user_info);
        $resultSet3 = $statement3->execute();
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