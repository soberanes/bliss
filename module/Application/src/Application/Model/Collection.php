<?php
namespace Application\Model;

use Zend\Http\PhpEnvironment\Request;
use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\FileInput;
use Zend\Validator;

class Collection implements InputFilterAwareInterface
{
	public $id;
	public $name;
	public $date_created;

	//Validate the data array for real data
	public function exchangeArray($data){
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->name = (isset($data['name'])) ? $data['name'] : null;
		$this->date_created = (isset($data['date_created'])) ? $data['date_created'] : null;
	}

	//Exploding the object result to use in vars mode
	public function getArrayCopy(){
        return get_object_vars($this);
    }

    //Setting up the input filter
	public function setInputFilter(InputFilterInterface $inputFilter){
        throw new \Exception("Not used");
    }

    //Filtering the result to validate data
    public function getInputFilter(){
    	/*
		 * validate data:
		 * -id
		 * -name
		 * -date_created
		 * */

    	if(!$this->inputFilter){
            $inputFilter = new InputFilter();
            
			//id
            $inputFilter->add(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));
            
			//name
            $inputFilter->add(array(
                'name' => 'name',
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
                            'min' => 1,
                            'max' => 250,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
	}
}