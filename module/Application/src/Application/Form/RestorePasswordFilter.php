<?php
namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class RestorePasswordFilter extends InputFilter
{
	public function __construct($sm){

		// self::__construct(); // parnt::__construct(); - trows and error

		$this->add(array(
			'name' => 'password',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 6,
						'max' => 12,
					),
				),
			),
		));	

		$this->add(array(
			'name' => 'password_confirm',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 6,
						'max' => 12,
					),
				),
				array(
					'name' => 'Identical',
					'options' => array(
						'token' => 'password',
					),
				),
			),
		));	
	}
}