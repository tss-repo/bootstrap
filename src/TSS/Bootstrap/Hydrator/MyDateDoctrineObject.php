<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 30/10/2015
 * Time: 13:30 PM
 */

namespace TSS\Bootstrap\Hydrator;


use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class MyDateDoctrineObject extends DoctrineObject
{
    /**
     * Handle various type conversions that should be supported natively by Doctrine (like DateTime)
     *
     * @param  mixed $value
     * @param  string $typeOfField
     * @return \DateTime
     */
    protected function handleTypeConversions($value, $typeOfField)
    {

        switch($typeOfField) {
            case 'datetimetz':
            case 'datetime':
            case 'time':
            case 'date':
                if ('' === $value) {
                    return null;
                }

                if (is_int($value)) {
                    $dateTime = new \DateTime();
                    $dateTime->setTimestamp($value);
                    $value = $dateTime;
                } elseif (is_string($value)) {
                    $timestamp = strtotime(str_replace('/', '-', $value));
                    $value = new \DateTime(date('Y-m-d h:i:s', $timestamp));
                }

                break;
            default:
        }

        return $value;
    }
}