<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 26/10/2015
 * Time: 16:52
 */

namespace TSS\Bootstrap\Form\View\Helper;


use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow as FormRowHelper;

class FormCheckbox extends FormRowHelper
{

    public function __invoke(ElementInterface $element = null, $labelPosition = null, $renderErrors = null, $partial = null)
    {
        if (!$element) {
            return $this;
        }

        if ($labelPosition !== null) {
            $this->setLabelPosition($labelPosition);
        } elseif ($this->labelPosition === null) {
            $this->setLabelPosition(self::LABEL_PREPEND);
        }

        if ($renderErrors !== null) {
            $this->setRenderErrors($renderErrors);
        }

        if ($partial !== null) {
            $this->setPartial($partial);
        } else {
            $this->setPartial('form/checkbox');
        }

        return $this->render($element);
    }
}