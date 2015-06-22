<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
	
    //remove
    private function _predump($value){
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die;
    }

    //getting fetch all
	public function fetchAll(){
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    //getting user by id
    public function getUser($usr_id){
        $usr_id = (int) $usr_id;
        $rowset = $this->tableGateway->select(array('user_id' => $usr_id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $user_id");
        }

        return $row;
    }

    //changing password
    public function changePassword($usr_id, $password){
        $data['password'] = $password;
        $this->tableGateway->update($data, array('user_id' => (int)$usr_id));
    }

    //saving user
    public function saveUser(User $user){
        // for Zend\Db\TableGateway\TableGateway we need the data in array not object
        
        $data = array(
            'password' => $user->password,
        );

        // If there is a method getArrayCopy() defined in Auth you can simply call it.
        // $data = $user->getArrayCopy();
        $usr_id = (int)$user->id;

        if ($usr_id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($usr_id)) {
                $this->tableGateway->update($data, array('user_id' => $usr_id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

}