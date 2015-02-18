<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cshelperzfcuser\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class Recovery extends Form implements InputFilterProviderInterface {

    function __construct() {
        parent::__construct();
        $this->add(
                array(
                    'type' => 'Text',
                    'name' => 'email',
                    'options' => array(
                        'label' => 'Correo Electrónico',
                    ),
                    'attributes' => array(
                        'id' => 'email',
                        'class' => 'form-control',
                        'required' => 'required',
                        'label' => 'Correo Electrónico',
                    )
                )
        );
    }

    public function getInputFilterSpecification() {
        $elements = $this->getElements();
        $return = array();
        foreach ($elements as $element) {
            $attr = $element->getAttribute('required');
            $name = $element->getAttribute('name');
            switch ($name) {
                default :
                    if (null !== $attr) {
                        $return[$name] = array(
                            'required' => true,
                            'error' => 'aksdkd',
                        );
                    }
                    break;
            }
        }
        return $return;
    }

}
