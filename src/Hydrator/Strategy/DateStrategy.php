<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 30/10/2015
 * Time: 13:29 PM
 */

namespace TSS\Bootstrap\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;

class DateStrategy implements StrategyInterface
{
    public function extract($value)
    {
        if ($value != null) {
            return $value->format('d/m/Y');
        }

        return $value;
    }

    public function hydrate($value)
    {
        if ($value instanceof \DateTime) {
            return $value;
        }

        if (is_string($value)) {
            $timestamp = strtotime(str_replace('/', '-', $value));
            return new \DateTime(date('Y-m-d', $timestamp));
        }

        return $value;
    }
}
