<?php
/**
 * Clase para obtener status de usuarios y mostrar formulario
 * donde los usuarios completen su perfil.
 * 
 * @author psoberanes
 *
 */

namespace Cshelperzfcuser\Model\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\HydratorInterface;

class UserInfoProfile extends AbstractDbMapper {

	protected $tableName = 'user_info';

	public function fetchAll(){
        $select = $this->getSelect();
        $entity = $this->select($select);
        
        return $entity;
    }
	
    public function getUserInfoProfile($user_id) {
        $select = $this->getSelect();
        $select->where->like('user_id', $user_id);

        $resultSet = $this->select($select)->current();
        
        return $resultSet;   
    }

	public function getUserByFullname($fullname) {
        $select = $this->getSelect();
        $select->where->like('fullname', $fullname);

        $resultSet = $this->select($select)->current();
        
        return $resultSet;   
	}

    private function toArray($array){

        foreach ($array as $key => $value) {
            $toArray[$key] = $value;
        }

        return $toArray;
    }

}