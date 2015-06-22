<?php
namespace Application\Form;

use Zend\Form\Form;

class AlbumForm extends Form {
    public function __construct($name = null){
        //ignore the name passed
        parent::__construct('album');
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));
        
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'options' => array(
                'label' => 'Titulo',
            ),
        ));
        
        $this->add(array(
            'name' => 'artist',
            'type' => 'Text',
            'options' => array(
                'label' => 'Artista',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'values' => 'Enviar',
                'id' => 'submitbutton',
            ),
        ));
    }
}