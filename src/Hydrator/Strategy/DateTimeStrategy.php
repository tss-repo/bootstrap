<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace TSS\Bootstrap\Hydrator\Strategy;

use Jenssegers\Date\Date;
use Zend\Hydrator\Strategy\StrategyInterface;

class DateTimeStrategy implements StrategyInterface
{
    /**
     * @var string
     */
    protected $time = 'H:i';

    /**
     * @var \IntlDateFormatter
     */
    protected $formatter;

    /**
     * DateTimeStrategy constructor.
     * @param string $time
     */
    public function __construct($time = 'H:i')
    {
        $this->formatter = new \IntlDateFormatter(null, \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE);
        $this->time = $time;
    }

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
            return Date::createFromFormat($this->getDateFormat(), $value);
        }

        return $value;
    }

    private function getDateFormat() {
        $patterns = array(
            '/11\D21\D(1999|99)/',
            '/21\D11\D(1999|99)/',
            '/(1999|99)\D11\D21/',
        );
        $replacements = array('m/d/Y', 'd/m/Y', 'Y/m/d');

        $date = new \DateTime();
        $date->setDate(1999, 11, 21);
        return preg_replace($patterns, $replacements, $this->formatter->format($date)) . ' ' . $this->time;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
}
