<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter;

class CollectionForm extends Form
{
	public function __construct($name = null){
        //ignore the name passed
        parent::__construct('collection');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            )
        ));
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-name',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nombre',
            ),
        ));

    }
}