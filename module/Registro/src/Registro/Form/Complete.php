<?php
namespace Registro\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Complete extends Form
{
	public function __construct($name = null){
		parent::__construct('complete-form');
        $this->setAttribute('method', 'post');

        //user_id
        $this->add(array(
            'name' => 'user_id',
            'type' => 'Hidden',
        ));

        //sucursal
        $this->add(array(
            'name' => 'sucursal',
            'type' => 'Hidden',
        ));

        //fullname
        $this->add(array( 
            'name' => 'fullname',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'fullname',
                'class'=>'admin-txt textbox',
                'placeholder' => 'Nombre y apellidos'
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
                'class'=>'admin-txt textbox',
                'placeholder' => 'Número de 10 dígitos'
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
                'class'=>'admin-txt textbox',
                'placeholder' => 'Número de 10 dígitos'
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
                'class'=>'admin-txt textbox',
                'placeholder' => 'ejemplo@dominio.com'
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
                'class'=>'admin-txt textbox',
                'placeholder' => 'Clic para seleccionar',
                'readonly' => 'readonly'
            ),
            'options' => array(
                'label' => 'Fecha de nacimiento',
            ),
        ));

        //domicilio
        $this->add(array( 
            'name' => 'domicilio',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'domicilio',
                'class'=>'admin-txt textbox',
                'placeholder' => 'Calle, número, colonia'
            ),
            'options' => array(
                'label' => 'Domicilio',
            ),
        ));

        //municipio
        $this->add(array( 
            'name' => 'municipio',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'municipio',
                'class'=>'admin-txt textbox',
                'placeholder' => 'Municipio'
            ),
            'options' => array(
                'label' => 'Municipio',
            ),
        ));

        //codigo postal
        $this->add(array( 
            'name' => 'zipcode',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'zipcode',
                'class'=>'admin-txt textbox',
                'placeholder' => 'Numérico'
            ),
            'options' => array(
                'label' => 'Código postal',
            ),
        ));

        //estado
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'estado',
            'attributes' => array(
                'id' => 'txt-estado',
                'class' => 'admin-txt textbox select',
            ),
            'options' => array(
                'label' => 'Estado',
                'empty_option'  => 'Selecciona un estado',
            )
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