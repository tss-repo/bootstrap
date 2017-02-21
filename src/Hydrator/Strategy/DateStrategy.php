<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 30/10/2015
 * Time: 13:29 PM
 */

namespace TSS\Bootstrap\Hydrator\Strategy;

use Jenssegers\Date\Date;
use Zend\Hydrator\Strategy\StrategyInterface;

class DateStrategy implements StrategyInterface
{
    public function extract($value)
    {
        if ($value != null) {
            return $value->format($this->getDateFormat());
        }

        return $value;
    }

    public function hydrate($value)
    {
        if ($value instanceof \DateTime) {
            return $value;
        }

        if (is_string($value)) {
            return Date::createFromFormat($this->getDateFormat() . ' H:i', $value . ' 00:00');
        }

        return $value;
    }

    private function getDateFormat() {
        $formatter = new \IntlDateFormatter(null, \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE);

        $patterns = array(
            '/11\D21\D(1999|99)/',
            '/21\D11\D(1999|99)/',
            '/(1999|99)\D11\D21/',
        );
        $replacements = array('m/d/Y', 'd/m/Y', 'Y/m/d');

        $date = new \DateTime();
        $date->setDate(1999, 11, 21);
        return preg_replace($patterns, $replacements, $formatter->format($date));
    }
}
