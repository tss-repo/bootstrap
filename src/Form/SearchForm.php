<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
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

        $this->add([
            'name' => 'q',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control input-dark-bg'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'class' => 'btn btn-default',
                'value' => '<i class="fa fa-search"></i>',
            ],
        ]);

        $inputFilter = new InputFilter();
        $inputFilter->add([
            'name' => 'q',
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'max' => 256,
                    ],
                ],
            ],
        ]);

        $this->setInputFilter($inputFilter);
    }
}
