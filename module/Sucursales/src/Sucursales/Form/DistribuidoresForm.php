<?php

namespace Sucursales\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class DistribuidoresForm extends Form {

    public function __construct(){        
        //ignore the name passed
        parent::__construct('product');

        $this->add(array(
            'name' => 'distribuidor_id',
            'type' => 'Hidden',
        ));
		
		//fullname
        $this->add(array( 
            'name' => 'nombre',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'txt-nombre',
                'class'=>'admin-txt textbox'
            ),
            'options' => array(
                'label' => 'Nombre distribuidor',
            ),
        ));
    
    }
}