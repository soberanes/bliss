<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter;

class CollectionRelationsForm extends Form
{
	public function __construct($name = null){
        //ignore the name passed
        parent::__construct('collection-relations');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            )
        ));
        

    }
}