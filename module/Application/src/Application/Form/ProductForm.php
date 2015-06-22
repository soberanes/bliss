<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter;

use Zend\Db\Adapter\AdapterInterface;

class ProductForm extends Form {

    protected $dbAdapter;

    public function __construct(AdapterInterface $dbAdapter){

        $this->setDbAdapter($dbAdapter);
        
        //ignore the name passed
        parent::__construct('product');
        
	    $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            )
        ));
        
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-name',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nombre',
            ),
        ));
        
        $this->add(array(
            'name' => 'code',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-code',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Código',
            ),
        ));
		
		$this->add(array(
            'name' => 'price',
            'attributes' => array(
                'type'  => 'number',
                'id' => 'txt-price',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Precio',
            ),
        ));

        $this->add(array(
            'name' => 'material',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-material',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Material',
            ),
        ));
		
		$this->add(array(
            'name' => 'baseimage',
            'attributes' => array(
                'type'  => 'image-file',
                'id' => 'txt-baseimage',
                'class' => 'form-control form-upload',
            ),
            'options' => array(
                'label' => 'Imagen principal Producto (PNG)',
            ),
        ));

        /* svg section */
        $this->add(array(
            'name' => 'imagepng1',
            'attributes' => array(
                'type'  => 'image-file',
                'id' => 'txt-imagepng1',
                'class' => 'form-control form-upload',
            ),
            'options' => array(
                'label' => 'Imagen de Producto (PNG - escenario clásico)',
            ),
        ));

        $this->add(array(
            'type'  => 'Zend\Form\Element\Textarea',
            'name' => 'svgcode1',
            'attributes' => array(
                'id' => 'txt-svgcode1',
                'class' => 'form-control svg-control',
            ),
            'options' => array(
                'label' => 'SVG (escenario clásico)',
            ),
        ));

        $this->add(array(
            'name' => 'imagepng2',
            'attributes' => array(
                'type'  => 'image-file',
                'id' => 'txt-imagepng2',
                'class' => 'form-control form-upload',
            ),
            'options' => array(
                'label' => 'Imagen de Producto (PNG - escenario clásico)',
            ),
        ));

        $this->add(array(
            'type'  => 'Zend\Form\Element\Textarea',
            'name' => 'svgcode2',
            'attributes' => array(
                'id' => 'txt-svgcode2',
                'class' => 'form-control svg-control',
            ),
            'options' => array(
                'label' => 'SVG (escenario clásico)',
            ),
        ));

        $this->add(array(
            'name' => 'imagepng3',
            'attributes' => array(
                'type'  => 'image-file',
                'id' => 'txt-imagepng3',
                'class' => 'form-control form-upload',
            ),
            'options' => array(
                'label' => 'Imagen de Producto (PNG - escenario clásico)',
            ),
        ));

        $this->add(array(
            'type'  => 'Zend\Form\Element\Textarea',
            'name' => 'svgcode3',
            'attributes' => array(
                'id' => 'txt-svgcode3',
                'class' => 'form-control svg-control',
            ),
            'options' => array(
                'label' => 'SVG (escenario clásico)',
            ),
        ));
        /* END svg section */

        //categories select
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'category',
            'attributes' => array(
                'id' => 'txt-category',
                'class' => 'form-control select',
            ),
            'options' => array(
                'label' => 'Categoría',
                'value_options' =>  $this->getOptionsForSelect('categories'),
                'empty_option'  => '--- Seleccione una categoría ---',
            )
        ));

        //collections select
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'collection',
            'attributes' => array(
                'id' => 'txt-collection',
                'class' => 'form-control select',
            ),
            'options' => array(
                'label' => 'Colección',
                'value_options' =>  $this->getOptionsForSelect('collections'),
                'empty_option'  => '--- Seleccione una categoría ---',
            )
        ));


        /*
		$this->add(array(
            'name' => 'category',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-category',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Categoría',
            ),
        ));
        */
		
    }

    public function getOptionsForSelect($table){

        $dbAdapter = $this->getDbAdapter();
        $sql       = 'SELECT t0.id, t0.name FROM '.$table.' t0 ORDER BY t0.name ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['id']] = $res['name'];
        }

        return $selectData;
    }

    public function setDbAdapter(AdapterInterface $dbAdapter){

        $this->dbAdapter = $dbAdapter;

        return $this;
    }

    public function getDbAdapter(){

        return $this->dbAdapter;
    }


}