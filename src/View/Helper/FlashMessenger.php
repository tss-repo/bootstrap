<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 01/09/2015
 * Time: 14:14
 */

namespace TSS\Bootstrap\View\Helper;

use Zend\View\Helper\FlashMessenger as FlashMessengerHelper;
use Zend\View\Helper\AbstractHelper;

class FlashMessenger extends AbstractHelper
{
    /**
     * @var FlashMessengerHelper
     */
    protected $flashMessengerHelper;

    public function __invoke()
    {
        return $this->render();
    }

    public function render()
    {
        $divOpen = '<div class="flashmessenger">';
        $divClose = '</div>';

        // default
        if ($this->getFlashMessengerHelper()->hasCurrentMessages()) {
            echo $this->getFlashMessengerHelper()->renderCurrent('default', array('alert', 'alert-success', 'animated', 'shake'));
            $this->getFlashMessengerHelper()->clearCurrentMessagesFromNamespace('default');
        } else {
            echo $this->getFlashMessengerHelper()->render('default', array('alert', 'alert-success', 'animated', 'shake'));
        }

        // success
        if ($this->getFlashMessengerHelper()->hasCurrentSuccessMessages()) {
            echo $this->getFlashMessengerHelper()->renderCurrent('success', array('alert', 'alert-success', 'animated', 'shake'));
            $this->getFlashMessengerHelper()->clearCurrentMessagesFromNamespace('success');
        } else {
            echo $this->getFlashMessengerHelper()->render('success', array('alert', 'alert-success', 'animated', 'shake'));
        }

        // info
        if ($this->getFlashMessengerHelper()->hasCurrentInfoMessages()) {
            echo $this->getFlashMessengerHelper()->renderCurrent('info', array('alert', 'alert-info', 'animated', 'shake'));
            $this->getFlashMessengerHelper()->clearCurrentMessagesFromNamespace('info');
        } else {
            echo $this->getFlashMessengerHelper()->render('info', array('alert', 'alert-info', 'animated', 'shake'));
        }

        // warning
        if ($this->getFlashMessengerHelper()->hasCurrentWarningMessages()) {
            echo $this->getFlashMessengerHelper()->renderCurrent('warning', array('alert', 'alert-warning', 'animated', 'shake'));
            $this->getFlashMessengerHelper()->clearCurrentMessagesFromNamespace('warning');
        } else {
            echo $this->getFlashMessengerHelper()->render('warning', array('alert', 'alert-warning', 'animated', 'shake'));
        }

        // error
        if ($this->getFlashMessengerHelper()->hasCurrentErrorMessages()) {
            echo $this->getFlashMessengerHelper()->renderCurrent('error', array('alert', 'alert-danger', 'animated', 'shake'));
            $this->getFlashMessengerHelper()->clearCurrentMessagesFromNamespace('error');
        } else {
            echo $this->getFlashMessengerHelper()->render('error', array('alert', 'alert-danger', 'animated', 'shake'));
        }

        return $divOpen . '' . $divClose;
    }

    /**
     * Retrieve the FlashMessenger helper
     *
     * @return FlashMessengerHelper
     */
    protected function getFlashMessengerHelper()
    {
        if ($this->flashMessengerHelper) {
            return $this->flashMessengerHelper;
        }

        if (method_exists($this->view, 'plugin')) {
            $this->flashMessengerHelper = $this->view->plugin(FlashMessengerHelper::class);
        }

        if (!$this->flashMessengerHelper instanceof FlashMessengerHelper) {
            $this->flashMessengerHelper = new FlashMessengerHelper();
        }

        return $this->flashMessengerHelper;
    }
}