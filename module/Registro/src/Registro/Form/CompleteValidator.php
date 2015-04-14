<?php
namespace Registro\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class CompleteValidator  implements InputFilterAwareInterface{

	protected $inputFilter;

	public function setInputFilter(InputFilterInterface $inputFilter){ 
        throw new \Exception("Not used"); 
    }

    public function getInputFilter() 
    {
    	if (!$this->inputFilter){
    		$inputFilter = new InputFilter();
            $factory = new InputFactory();

            //fullname
            $inputFilter->add($factory->createInput(array(
                'name'     => 'fullname',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            )));

            //phone
            $inputFilter->add(array(
                'name'       => 'phone',
                'required'   => false,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 10,
                        ),
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            //cellphone
            $inputFilter->add(array(
                'name'       => 'cellphone',
                'required'   => false,
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'min' => 10,
                        ),
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            //email
            $inputFilter->add(array(
                'name'       => 'email',
                'required'   => true,
                'validators' => array(
                   array(
                        'name' => 'EmailAddress',
                        'options' =>array(
                            'domain'   => 'true',
                            'hostname' => 'true',
                            'mx'       => 'true',
                            'deep'     => 'true',
                            'message'  => 'Dirección de correo inválida.',
                        ),
                    ),
                ),
                'filters'   => array(
                    array('name' => 'StringTrim'),
                ),
            ));

            //birthdate
            $inputFilter->add($factory->createInput(array(
                'name'     => 'birthdate',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
            )));

            //domicilio
            $inputFilter->add($factory->createInput(array(
                'name'     => 'domicilio',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
            )));
            
            //municipio
            $inputFilter->add($factory->createInput(array(
                'name'     => 'municipio',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
            )));

            //codigo postal
            $inputFilter->add($factory->createInput(array(
                'name'     => 'zipcode',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
            )));

            //estado
            $inputFilter->add($factory->createInput(array(
                'name'     => 'estado',
                'required' => true,
            )));
            
            $this->inputFilter = $inputFilter;
    	}

    	return $this->inputFilter;
    }
}