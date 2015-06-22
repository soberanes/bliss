<?php
namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter;

use Zend\Db\Adapter\AdapterInterface;

class SalesForm extends Form {

    protected $dbAdapter;

    public function __construct(AdapterInterface $dbAdapter){

        $this->setDbAdapter($dbAdapter);
        
        //ignore the name passed
        parent::__construct('sales');
        
	    $this->add(array(
            'name' => 'sale_id',
            'attributes' => array(
                'type'  => 'hidden',
            )
        ));
        
        $this->add(array(
            'name' => 'cantidad',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-qty',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cantidad',
            ),
        ));
        
		$this->add(array(
            'name' => 'producto',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-product',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Producto',
            ),
        ));
        
		$this->add(array(
            'name' => 'precio',
            'attributes' => array(
                'type'  => 'text',
                'id' => 'txt-price',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Precio Unitario',
            ),
        ));
        
		//type select
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'tipo',
            'attributes' => array(
                'id' => 'txt-tipo',
                'class' => 'form-control select',
            ),
            'options' => array(
                'label' => 'Tipo de venta',
                'value_options' =>  array(
					0 => "Crédito",
					1 => "Contado"
				),
                'empty_option'  => '--- Tipo---',
            )
        ));
		
		//client select
        $this->add(array(
            'type'  => 'Zend\Form\Element\Select',
            'name' => 'client',
            'attributes' => array(
                'id' => 'txt-client',
                'class' => 'form-control select',
            ),
            'options' => array(
                'label' => 'Cliente',
                'value_options' =>  $this->getOptionsForSelect('clients'),
                'empty_option'  => '--- Seleccione un cliente ---',
            )
        ));
		
    }

	public function getOptionsForSelect($table){

        $dbAdapter = $this->getDbAdapter();
        $sql       = 'SELECT t0.client_id, t0.firstname FROM '.$table.' t0 ORDER BY t0.firstname ASC';
        $statement = $dbAdapter->query($sql);
        $result    = $statement->execute();

        $selectData = array();

        foreach ($result as $res) {
            $selectData[$res['client_id']] = $res['firstname'];
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