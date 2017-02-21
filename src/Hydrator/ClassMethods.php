<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace TSS\Bootstrap\Hydrator;

use TSS\Bootstrap\Hydrator\Strategy\DateTimeStrategy;

class ClassMethods extends \Zend\Hydrator\ClassMethods
{
    /**
     * @param bool|true $underscoreSeparatedKeys
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);

        $dateTimeStrategy = new DateTimeStrategy();
        $this->strategies['createdAt'] = $dateTimeStrategy;
        $this->strategies['updatedAt'] = $dateTimeStrategy;
    }
}