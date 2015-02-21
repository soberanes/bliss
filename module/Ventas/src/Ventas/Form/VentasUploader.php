<?php

namespace Ventas\Form;

use Zend\InputFilter;
use Zend\Form\Form;
use Zend\Form\Element;

class VentasUploader extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->addElements();
        $this->setInputFilter($this->createInputFilter());
    }

    public function addElements() {
        // File Input
        $file = new Element\File('archivo');
        $file->setAttributes(array(
                'id' => 'uploadBtn',
                'class' => 'upload'
             )
        );
        $this->add($file);
    }

    public function createInputFilter() {
        $inputFilter = new InputFilter\InputFilter();

        // File Input
        $file = new InputFilter\FileInput('archivo');
        $file->setRequired(true);
        $file->getFilterChain()->attachByName(
                'filerenameupload', array(
            'target' => './data/tmpuploads/',
            'overwrite' => false,
            'use_upload_name' => true,
            'randomize' => true,
                )
        );
        $inputFilter->add($file);

        // Text Input
        $text = new InputFilter\Input('name');
        $text->setRequired(true);
        $inputFilter->add($text);

        return $inputFilter;
    }

}
