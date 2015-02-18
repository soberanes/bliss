<?php
namespace Cshelperzfcuser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class CompleteRef extends Form
{
	public function __construct(){
		parent::__construct('complete-ref');
        $this->setAttribute('method', 'post');

        //razon social
        $this->add(array( 
            'name' => 'razon_social',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'razon_social',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Razón social del distribuidor',
            ),
        ));

        //nombre
        $this->add(array( 
            'name' => 'nombre',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'nombre',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Nombre completo',
            ),
        ));

        //nombre_distribuidor
        $this->add(array( 
            'name' => 'nombre_distribuidor',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'nombre_distribuidor',
                'class'=>'form-control'
            ),
            'options' => array(
                    'label' => 'Nombre del distribuidor',
            ),
        ));

        //nombre_vendedor
        $this->add(array( 
            'name' => 'nombre_vendedor',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'nombre_vendedor',
                'class'=>'form-control'
            ),
            'options' => array(
                    'label' => 'Nombre del vendedor',
            ),
        ));

        //domicilio
        $this->add(array( 
            'name' => 'domicilio',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'domicilio',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Domicilio',
            ),
        ));

        //estado
        $this->add(array( 
            'name' => 'estado',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array( 
                'id' => 'estado',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Estado',
                'empty_option' => 'Selecciona un estado',
                'value_options' => array(),
            ),
        ));

        //cp
        $this->add(array( 
            'name' => 'cp',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'cp',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'C.P.',
            ),
        ));

        //telefono
        $this->add(array( 
            'name' => 'telefono',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'telefono',
                'class'=>'form-control'
            ),
            'options' => array(
                'label' => 'Teléfono',
            ),
        ));

        //celular
        $this->add(array( 
            'name' => 'celular',
            'type' => 'text', 
            'attributes' => array( 
                'id' => 'celular',
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
                'label' => 'E-mail',
            ),
        ));

        $this->add(array(
            'name' => 'btn_save',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Guardar',
                'id' => 'btn_save_customer',
                'class'=>'btn btn-success'
            ),
        ));

	}
	
}