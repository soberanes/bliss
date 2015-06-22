<?php
namespace Application\Form;
use Zend\Form\Form;

class RestorePasswordForm extends Form
{
	public function __construct($name = null){

		parent::__construct('restorePassword');

		$this->setAttribute('method', 'post');
        
		$this->add(array(
			'name' => 'password',
			'attributes' => array(
				'type' => 'password',
				'id' => 'txt-password',
                'class' => 'form-control',
			),
			'options' => array(
				'label' => 'Nueva contraseña',
			),
		));

		$this->add(array(
			'name' => 'password_confirm',
			'attributes' => array(
				'type' => 'password',
				'id' => 'txt-confirm',
                'class' => 'form-control',
			),
			'options' => array(
				'label' => 'Confirmar contraseña',
			),
		));	

	}
}