<?php
namespace Application\Form;

use Zend\Form\Form;

class LoginForm extends Form {
    public function __construct($name = null){
        //ignore the name passed
        parent::__construct('auth');
        
        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-username',
                'class' => 'form-control',
                'placeholder' => 'Nombre de usuario',
            )
        ));
        
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'id' => 'txt-password',
                'class' => 'form-control',
                'placeholder' => 'Contraseña',
            )
        ));
		
		//btn btn-default
		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
            	'type' => 'submit',
                'values' => 'Login',
                'id' => 'btn-login',
                'class' => 'btn btn-default',
            )
        ));
    }
}