<?php

namespace Sucursales\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class SucursalesForm extends Form {

    public function __construct(){        
        //ignore the name passed
        parent::__construct('product');

        $this->add(array(
            'name' => 'sucursal_id',
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
                'label' => 'Nombre sucursal',
            ),
        ));

        //collections select
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'distribuidor',
            'attributes' => array(
                'id' => 'txt-distribuidor',
                'class' => 'admin-txt textbox select',
            ),
            'options' => array(
                'label' => 'Distribuidor',
                //'value_options' =>  $this->getOptionsForSelect('distribuidores'),
                'empty_option'  => 'Selecciona un distribuidor',
            )
        ));
	
	}

}