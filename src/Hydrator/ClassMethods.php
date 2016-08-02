<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 30/10/2015
 * Time: 13:30 PM
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