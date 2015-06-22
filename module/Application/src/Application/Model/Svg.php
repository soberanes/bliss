<?php
namespace Application\Model;

use Zend\Http\PhpEnvironment\Request;
use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\FileInput;
use Zend\Validator;

class Svg implements InputFilterAwareInterface
{
	public $id;
	public $svg1;
	public $image1;
	public $svg2;
	public $image2;
	public $svg3;
	public $image3;

	//Validate the data array for real data
	public function exchangeArray($data){
        $this->id       	= (isset($data['id'])) ? $data['id'] : null;
        $this->svg1   		= (isset($data['svg1'])) ? $data['svg1'] : null;
        $this->image1   	= (isset($data['image1'])) ? $data['image1'] : null;
        $this->svg2   		= (isset($data['svg2'])) ? $data['svg2'] : null;
        $this->image2   	= (isset($data['image2'])) ? $data['image2'] : null;
        $this->svg3   		= (isset($data['svg3'])) ? $data['svg3'] : null;
        $this->image3   	= (isset($data['image3'])) ? $data['image3'] : null;
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
		 * -svg1
		 * -image1
		 * -svg2
		 * -image2
		 * -svg3
		 * -image3
		 **/

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


		}
	}

}