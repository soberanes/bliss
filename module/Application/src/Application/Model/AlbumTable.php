<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGategay;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;

class AlbumTable extends AbstractTableGateway
{
    protected $tableGateway;
    protected $table = 'album';
    
    public function __construct($tableGateway){
        $this->tableGateway = $tableGateway;

    }

    //remove
    private function _predump($value){
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
        die;
    }
    
    public function fetchAll(Select $select = null){

        if (null === $select)
            $select = new Select();
        $select->from($this->table);

        //$this->_predump($select->getSqlString());
        $resultSet = $this->tableGateway->selectWith($select);
        $resultSet->buffer();
        return $resultSet;
    
    }
    
    public function getAlbum($id){
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if(!$row){
            throw new \Exception("No podemos encontrar la fila con el id $id");
        }
        return $row;
    }
    
    public function saveAlbum(Album $album){
        $data = array(
            'artist' => $album->artist,
            'title' => $album->title
        );
        
        $id = (int) $album->id;
        if($id == 0){
            $this->tableGateway->insert($data);
        }else{
            if($this->getAlbum($id)){
                $this->tableGateway->update($data, array('id' => $id));
            }else{
                throw new \Exception("El ID del Album no existe");
            }
        }
    }
    
    public function deleteAlbum($id){
        $this->tableGateway->delete(array('id' => (int) $id));
    }
    
}