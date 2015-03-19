<?php
namespace Registro\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Complete extends Form
{
	public function __construct($name = null){
		parent::__construct('complete-form');
        $this->setAttribute('method', 'post');

       	//fullname
        $this->add(array( 
            'name' => 'fullname',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'fullname',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Nombre completo',
            ),
        ));
		
		//phone
        $this->add(array( 
            'name' => 'phone',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'phone',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Teléfono',
            ),
        ));
		
		//cellphone
        $this->add(array( 
            'name' => 'cellphone',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'cellphone',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Celular',
            ),
        ));
		
		//email
        $this->add(array( 
            'name' => 'email',
            'type' => 'email', 
            'attributes' => array( 
                'id' => 'email',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Correo Electrónico',
            ),
        ));
				
		//birthdate
        $this->add(array( 
            'name' => 'birthdate',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'birthdate',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Fecha de nacimiento',
            ),
        ));

        //address
        $this->add(array( 
            'name' => 'address',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'address',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Dirección',
            ),
        ));
		
		//btn-save
		$this->add(array(
            'name' => 'btn_save',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'id' => 'btn_save',
                'class'=>'btn btn-success'
            ),
        ));
		
	}	
}