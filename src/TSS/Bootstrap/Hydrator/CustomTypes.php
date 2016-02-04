<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 30/10/2015
 * Time: 13:30 PM
 */

namespace TSS\Bootstrap\Hydrator;


use TSS\Bootstrap\Hydrator\Strategy\DateTimeStrategy;
use Zend\Stdlib\Hydrator\ClassMethods;

class CustomTypes extends ClassMethods
{
    /**
     * @param bool|true $underscoreSeparatedKeys
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);


        $bdTimeStrategy = new DateTimeStrategy();
        $this->strategies['created'] = $bdTimeStrategy;
        $this->strategies['modified'] = $bdTimeStrategy;
    }
}