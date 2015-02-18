<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cspermission\Model;

use Zend\Permissions\Acl\Acl as Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocatorInterface;

class Aclbasic extends Acl{    
    
    protected $cache;
    
    protected $idcache;

    protected $sm;


    public function __construct(array $params,ServiceLocatorInterface $sm) {
        if(is_array($params)){
            $this->sm = $sm;
            $this->setCache($params['cache']);
            $this->setIdcache($params['idcache']);
            $this->addRoles();
            $this->addRecurso();
            $this->addPermisos();
        }
    }
    
    public function getCache() {
        return $this->cache;
    }

    public function setCache($cache) {
        $this->cache = $cache;
    }

    public function getIdcache() {
        return $this->idcache;
    }

    public function setIdcache($idcache) {
        $this->idcache = $idcache;
    }

    private function addRoles(){
        $cache = $this->getCache();        
        if( ($entities = $cache->getItem(
                'rolesParent'.$this->getIdcache()))===null) {
            $rolTable = $this->sm->get('Cspermission\Model\RolesTable');
            $entities = $rolTable->fetchAll();
            
          $cache->setItem('rolesParent'.$this->getIdcache(),$entities);
        }
        foreach ($entities as $row){
            $rol=$row['id'];
            $idparent=$row['id_parent'];
            if ($idparent===0){                
                $this->addRole(new Role($rol),null);
                
            }
            else {
                $this->addRole(new Role($rol),new Role($idparent));				
            }
        } 
    }
    
    private function addRecurso(){
        $cache = $this->getCache();
        
        $isResource = false;
        if( ($entities = $cache->getItem(
                'recursosParent'.$this->getIdcache())) === null ) {
            $resourceTable = $this->sm->get('Cspermission\Model\ResourceTable');
            $entities  = $resourceTable->fetchAll();
            $cache->setItem('recursosParent'.$this->getIdcache(),$entities);
        }
        foreach ($entities as $row){
            $recurso = $row['id'];
            $iddparent = $row['id_parent'];
            if($recurso!==null) $isResource = true;
            if($isResource){
                if($iddparent===0){
                    $this->addResource(
                            new Resource($recurso),null);
                }
                else{
                    $this->addResource(
                            new Resource($recurso),
                            new Resource($iddparent));
                }
            }			
        }        
    }
    
    private function addPermisos(){
        $cache = $this->getCache();
        $isResource  	= false;
        $permisos	= array();
        $recurso	= array();
        if( ($entities = $cache->getItem(
                'loadPermiso'.$this->getIdcache())) === null ) {
            $PermissionsTable = $this->sm->get('Cspermission\Model\PermissionsTable');
            $entities	= $PermissionsTable->findById($this->getIdcache());
            $cache->setItem('loadPermiso'.$this->getIdcache(),$entities);
        }
        $permisos['idrole']=  $this->getIdcache();
        foreach ($entities as $row){	
        $recurso	= $row['id_resource'];
            if($recurso!==null) $isResource = true;
            if($isResource){
                switch($row['permission']){
                    case 'deny': 
                        $permisos['deny'][]=$recurso;							
                    break;
                    case 'allow': 
                        $permisos['allow'][]=$recurso;
                    break;
                }
            }			
        }
        if (isset($permisos['deny'])){
            $this->deny($permisos['idrole'],$permisos['deny']);			
        }
        if (isset($permisos['allow'])){
            $this->allow($permisos['idrole'],$permisos['allow']);
        }        
    }    
    
    public function findResourceId($resource){
            $resourceTable = $this->sm->get('Cspermission\Model\ResourceTable');
            return $resourceTable->findId($resource);
    }
   
    public function isRole($id){
        $rolTable = $this->sm->get('Cspermission\Model\RolesTable');
        return $rolTable->isIdRole($id);
    }
}

