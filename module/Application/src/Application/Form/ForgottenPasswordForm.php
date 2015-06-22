<?php
namespace Application\Form;
use Zend\Form\Form;

class ForgottenPasswordForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('user');
		
		$this->setAttribute('method', 'post');
		
		$this->add(array(
			'name' => 'usr_email',
			'attributes' => array(
				'type' => 'email',
				'class' => 'form-control',
                'placeholder' => 'Correo electrónico',
			),
		));

		$this->add(array(
            'name' => 'submit',
            'attributes' => array(
            	'type' => 'submit',
                'value' => 'Enviar',
                'id' => 'btn-password',
                'class' => 'btn btn-default',
            )
        ));
	}
}
