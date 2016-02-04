<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 18/07/2015
 * Time: 14:28
 */

namespace TSS\Bootstrap\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class SearchForm extends Form
{

    public function __construct()
    {
        parent::__construct('search');
        $this->setAttribute('method', 'get');
        $this->setAttribute('class', 'form-inline');
        $this->setAttribute('role', 'form');
        $this->setLabel('Search');

        $this->add(array(
            'name' => 'q',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control input-dark-bg'
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'class' => 'btn btn-default',
                'value' => '<i class="fa fa-search"></i>',
            ),
        ));

        $inputFilter = new InputFilter();
        $inputFilter->add(array(
            'name' => 'q',
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max' => 256,
                    ),
                ),
            ),
        ));

        $this->setInputFilter($inputFilter);
    }

}