<?php

namespace Participantes\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class ParticipantesForm extends Form {

    public function __construct($name = null){
		parent::__construct('participantes-form');
        $this->setAttribute('method', 'post');
		
        //user_id
        $this->add(array(
            'name' => 'user_id',
            'type' => 'Hidden',
        ));

        //status
        $this->add(array(
            'name' => 'status',
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

        //sucursal
		$this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'sucursal',
            'attributes' => array(
                'id' => 'txt-sucursal',
                'class' => 'admin-txt textbox select',
            ),
            'options' => array(
                'label' => 'Sucursal',
            )
        ));

        //perfil
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'perfil',
            'attributes' => array(
                'id' => 'txt-perfil',
                'class' => 'admin-txt textbox select',
            ),
            'options' => array(
                'label' => 'Perfil',
                'value_options' =>  array(
                    array(
                       'value' => '1',
                       'label' => 'MKT Tecnolite',
                       'selected' => false,
                    ),
                    array(
                       'value' => '2',
                       'label' => 'Vendedor del distribuidor',
                       'selected' => false,
                    ),
                    array(
                       'value' => '3',
                       'label' => 'Encargado de sucursal',
                       'selected' => true,
                    ),
                    array(
                       'value' => '4',
                       'label' => 'Administrador ADV',
                       'selected' => false,
                    ),
                ),
                'empty_option'  => 'Selecciona un perfil',
            )
        ));

        //parent
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'parent',
            'attributes' => array(
                'id' => 'txt-parent',
                'class' => 'admin-txt textbox select',
            ),
            'options' => array(
                'label' => 'Encargado (parent)',
                'empty_option'  => 'Selecciona al encargado (parent)',
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