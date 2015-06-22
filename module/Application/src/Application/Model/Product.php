<?php
namespace Application\Model;

use Zend\Http\PhpEnvironment\Request;
use Zend\Filter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\FileInput;
use Zend\Validator;

class Product implements InputFilterAwareInterface
{
	public $id;
    public $name;
    public $code;
    public $baseimage;
    public $thumbnail;
    public $svgcode1;
    public $svgcode2;
    public $svgcode3;
    public $image1;
    public $image2;
    public $image3;
    public $category;
    public $collection;
    public $date_created;
    protected $inputFilter;

	
	//Validate the data array for real data
	public function exchangeArray($data){
        $this->id       	= (isset($data['id'])) ? $data['id'] : null;
        $this->name   		= (isset($data['name'])) ? $data['name'] : null;
        $this->code   		= (isset($data['code'])) ? $data['code'] : null;
        $this->price        = (isset($data['price'])) ? $data['price'] : null;
        $this->material     = (isset($data['material'])) ? $data['material'] : null;
        $this->svgcode1     = (isset($data['svgcode1'])) ? $data['svgcode1'] : null;
        $this->svgcode2     = (isset($data['svgcode2'])) ? $data['svgcode2'] : null;
        $this->svgcode3     = (isset($data['svgcode3'])) ? $data['svgcode3'] : null;
        $this->image1       = (isset($data['image1'])) ? $data['image1'] : null;
        $this->image2       = (isset($data['image2'])) ? $data['image2'] : null;
        $this->image3       = (isset($data['image3'])) ? $data['image3'] : null;
        $this->category     = (isset($data['category'])) ? $data['category'] : null;
        $this->collection   = (isset($data['collection'])) ? $data['collection'] : null;
        $this->baseimage	= (isset($data['baseimage'])) ? $data['baseimage'] : null;
        $this->thumbnail    = (isset($data['thumbnail'])) ? $data['thumbnail'] : null;
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
		 * -code
		 * -baseimage
		 * -thumbnail
		 * -svgcode
		 * -category
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
            
			//code
            $inputFilter->add(array(
                'name' => 'code',
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
			
			//price
            $inputFilter->add(array(
                'name' => 'price',
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

            //material
            $inputFilter->add(array(
                'name' => 'material',
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
            
			//category
            $inputFilter->add(array(
                'name' => 'category',
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

            //collection
            $inputFilter->add(array(
                'name' => 'collection',
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
			
			//baseimage - DON'T DO THIS
            /*
            $inputFilter->add(array(
                    'name'     => 'baseimage',
                    'required' => true,
                )
            );
            */
			
			
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
	
}