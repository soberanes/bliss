<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Uploader\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class Uploader extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->addElements();
        $this->setInputFilter($this->createInputFilter());
    }

    public function addElements() {
        // File Input
        $file = new Element\File('archivo');
        $file->setLabel('Seleccionar archivo')
                ->setAttributes(array('id' => 'archivo'));
        $this->add($file);

        $text = new Element\Text('name');
        $text->setLabel('Dale nombre a tu factura')
                ->setAttributes(array(
                    'id' => 'name',
                    'placeholder' => 'Nombre',
        ));
        $this->add($text);
    }

    public function createInputFilter() {
        $inputFilter = new InputFilter\InputFilter();
        $file = new InputFilter\FileInput('archivo');
        $file->setRequired(true);
        $file->getFilterChain()->attachByName(
                'filerenameupload', array(
                    'target' => './data/files/uploads/',
                    'overwrite' => false,
                    'use_upload_name' => false,
                    'use_upload_extension' => true,
                    'randomize' => true,
                )
        );
        $file->getValidatorChain()->attachByName('filesize', array('max' => 2097152))
                ->attachByName('fileextension', array('xlsx','xml'));
        $inputFilter->add($file);

        // Text Input
        $text = new InputFilter\Input('name');
        $text->setRequired(true);
        $inputFilter->add($text);

        return $inputFilter;
    }

}
