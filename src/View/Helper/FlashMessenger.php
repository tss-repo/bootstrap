<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 01/09/2015
 * Time: 14:14
 */

namespace TSS\Bootstrap\View\Helper;

use Zend\View\Helper\AbstractHelper;

class FlashMessenger extends AbstractHelper
{
    public function __invoke()
    {
        return $this;
    }

    public function render($partial = null)
    {
        if ($partial == null) {
            $partial = 'flashmessenger/default';
        }

        return $this->getView()->render($partial);
    }
}