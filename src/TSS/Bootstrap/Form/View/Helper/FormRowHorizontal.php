<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 02/09/2015
 * Time: 08:22
 */

namespace TSS\Bootstrap\Form\View\Helper;


use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow;

class FormRowHorizontal extends FormRow
{
    public function __invoke(ElementInterface $element = null, $colLabel = null, $labelPosition = null, $renderErrors = null, $partial = null)
    {
        if (!$element) {
            return $this;
        }

        if ($colLabel == null) {
            $colLabel = 3;
            $colElement = 9;
        } else {
            $colElement = (12 - $colLabel) > 0 ? 12 - $colLabel : 1;
        }
        $label_attributes = $element->getLabelAttributes();
        if (isset($label_attributes['class'])) {
            $label_attributes['class'] = 'col-xs-' . $colLabel . ' ' . $label_attributes['class'];
        } else {
            $label_attributes['class'] = 'control-label col-xs-' . $colLabel;
        }
        $element->setLabelAttributes($label_attributes);
        $element->setOption('col-element', 'col-xs-' . $colElement);

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
            $this->setPartial('form/row-horizontal');
        }

        return $this->render($element);
    }
}